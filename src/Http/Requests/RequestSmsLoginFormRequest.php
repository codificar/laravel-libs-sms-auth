<?php

namespace Codificar\Sms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Provider; // ajuste se o namespace do seu Model for diferente

class RequestSmsLoginFormRequest extends FormRequest
{
    private $provider;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // exige telefone em E.164 (+244..., +55..., etc.)
            'phone'    => ['required', 'regex:/^\+[1-9]\d{7,14}$/'],
            // provider não é mais obrigatório (será preenchido no prepareForValidation se existir)
            'provider' => ['nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        // 1) normaliza para E.164 (mantém '+', remove (), -, espaços)
        $raw = (string) $this->input('phone');
        $e164 = preg_replace('/[^\d\+]+/', '', $raw);
        if ($e164 !== '' && $e164[0] !== '+') {
            $e164 = '+' . ltrim($e164, '+');
        }

        // 2) extrai calling_code e número local
        [$callingCode, $local] = $this->splitE164($e164);

        // 3) busca o provider por calling_code + phone (formato que você disse que está no banco)
        $provider = null;
        if ($callingCode && $local) {
            $provider = Provider::query()
                ->where('calling_code', $callingCode)
                ->where(function ($q) use ($local) {
                    $q->where('phone', $local)
                      ->orWhereRaw(
                          "REPLACE(REPLACE(REPLACE(REPLACE(phone,' ',''),'-',''),'(',''),')','') = ?",
                          [preg_replace('/\D+/', '', $local)]
                      );
                })
                ->first();
        }

        // 4) fallbacks: caso o phone esteja salvo em E.164 ou só dígitos na coluna phone
        if (!$provider) {
            $digitsOnly = preg_replace('/\D+/', '', $e164);
            $provider = Provider::query()
                ->where('phone', $e164)                 // +244925...
                ->orWhere('phone', ltrim($e164, '+'))   // 244925...
                ->orWhere('phone', $digitsOnly)         // 244925... (só dígitos)
                ->first();
        }

        // 5) injeta no request
        $this->provider = $provider;
        $this->merge([
            'phone'    => $e164,
            'provider' => $provider, // pode ser null; rules permitem nullable
        ]);
    }

    /**
     * Caso a validação falhe, retorna os itens de erro
     */
    protected function failedValidation(Validator $validator)
    {
        $error_messages = $validator->errors()->all();

        throw new HttpResponseException(
            response()->json([
                'success'        => false,
                'error'          => $error_messages[0] ?? 'Falha na validação.',
                'error_code'     => \ApiErrors::REQUEST_FAILED,
                'error_messages' => $error_messages,
            ])
        );
    }

    /**
     * Divide um E.164 em [calling_code, local].
     * Ex.: +244925338340 -> ['+244', '925338340']
     *      +559998887776 -> ['+55',  '9998887776']
     */
    private function splitE164(string $e164): array
    {
        // liste os DDIs mais usados no seu app
        $known = ['244', '55', '595']; // Angola, Brasil, Paraguai (ajuste se precisar)

        foreach ($known as $cc) {
            if (strpos($e164, '+' . $cc) === 0) {
                return ['+' . $cc, substr($e164, 1 + strlen($cc))];
            }
        }

        // fallbacks genéricos: tenta 3 dígitos, depois 2
        if (preg_match('/^\+(\d{3})(\d+)$/', $e164, $m)) {
            return ['+' . $m[1], $m[2]];
        }
        if (preg_match('/^\+(\d{2})(\d+)$/', $e164, $m)) {
            return ['+' . $m[1], $m[2]];
        }

        return [null, null];
    }
}
