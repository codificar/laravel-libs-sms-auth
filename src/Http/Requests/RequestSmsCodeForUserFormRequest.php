<?php

namespace Codificar\Sms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
// Ajuste o import do seu model:
use User; // ou use App\Models\User;

class RequestSmsCodeForUserFormRequest extends FormRequest
{
    private $user;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // Exija phone em E.164 (+244..., +55..., etc.)
            'phone' => ['required', 'regex:/^\+[1-9]\d{7,14}$/'],
            // user deixa de ser obrigatório (ele será preenchido no prepareForValidation se existir)
            'user'  => ['nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        // 1) normaliza entrada p/ E.164 (mantém +, remove (), -, espaços)
        $raw = (string) $this->input('phone');
        $e164 = preg_replace('/[^\d\+]+/', '', $raw);
        if ($e164 !== '' && $e164[0] !== '+') {
            $e164 = '+' . ltrim($e164, '+');
        }

        // 2) extrai calling_code e número local
        [$callingCode, $local] = $this->splitE164($e164);

        // 3) tenta achar o usuário por calling_code + phone
        $user = null;
        if ($callingCode && $local) {
            $user = User::query()
                ->where('calling_code', $callingCode)
                ->where(function ($q) use ($local) {
                    // igual ao que você tem no BD (ex.: "925338340")
                    $q->where('phone', $local)
                      // fallbacks para formatos salvos com máscara
                      ->orWhereRaw(
                          "REPLACE(REPLACE(REPLACE(REPLACE(phone,' ',''),'-',''),'(',''),')','') = ?",
                          [preg_replace('/\D+/', '', $local)]
                      );
                })
                ->first();
        }

        // 4) fallbacks adicionais, caso sua base também tenha E.164 em 'phone'
        if (!$user) {
            $digitsOnly = preg_replace('/\D+/', '', $e164);
            $user = User::query()
                ->where('phone', $e164)       // +244925338340
                ->orWhere('phone', ltrim($e164, '+')) // 244925338340
                ->orWhere('phone', $digitsOnly)       // 244925338340 (só dígitos)
                ->first();
        }

        // 5) grava no request o phone normalizado e o user (se achou)
        $this->merge([
            'phone' => $e164,
            'user'  => $user, // pode ser null; as rules permitem nullable
        ]);

        $this->user = $user;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success'    => false,
                'errors'     => $validator->errors()->all(),
                'error_code' => \ApiErrors::REQUEST_FAILED
            ])
        );
    }

    /**
     * Divide um E.164 em [calling_code, local].
     * Ex.: +244925338340 -> ['+244', '925338340']
     *      +559998887776 -> ['+55', '9998887776']
     */
    private function splitE164(string $e164): array
    {
        // Liste os DDIs que você usa com mais frequência
        $known = ['244', '55', '595']; // Angola, Brasil, Paraguai — ajuste à sua realidade

        foreach ($known as $cc) {
            if (strpos($e164, '+'.$cc) === 0) {
                return ['+'.$cc, substr($e164, 1 + strlen($cc))];
            }
        }

        // fallback simples: tenta 3 dígitos, depois 2
        if (preg_match('/^\+(\d{3})(\d+)$/', $e164, $m)) {
            return ['+'.$m[1], $m[2]];
        }
        if (preg_match('/^\+(\d{2})(\d+)$/', $e164, $m)) {
            return ['+'.$m[1], $m[2]];
        }

        return [null, null];
    }
}
