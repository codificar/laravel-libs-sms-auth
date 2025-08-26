<?php

namespace Codificar\Sms\Http\Requests;

use Provider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use User;

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
            // validação em E.164 (+244..., +55..., etc.)
            'phone' => ['required', 'regex:/^\+[1-9]\d{7,14}$/'],
            // ATENÇÃO: 'user' não é mais obrigatório
            // aqui 'user' é um *model* (preenchido no prepareForValidation), então apenas 'nullable'
            'user'  => ['nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        // normaliza o phone (remove espaços, (), - ; mantém '+')
        $rawPhone = (string) $this->phone;
        $phone = preg_replace('/[^\d\+]+/', '', $rawPhone);
        $this->merge(['phone' => $phone]);

        // busca o usuário por telefone; se não existir, permanece null (e tudo bem)
        $this->user = User::getByPhone($phone);

        // mantém a mesma interface esperada pelo controller/resource
        $this->merge([
            'user' => $this->user
        ]);
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
}
