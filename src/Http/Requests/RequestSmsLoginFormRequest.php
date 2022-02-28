<?php

namespace Codificar\Sms\Http\Requests;

use Provider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestSmsLoginFormRequest extends FormRequest
{
	private $provider;

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'phone' => 'required',
			'provider' => 'required'
		];
	}

	protected function prepareForValidation()
	{
		$phone = $this->phone;
		$provider = Provider::getByPhone($phone);
		$this->provider = $provider;
		$this->merge([
			'provider' => $provider
		]);
	}

	/**
     * Caso a validação falhe, retorna os itens de erro
     * 
     * @return Json
     */
    protected function failedValidation(Validator $validator) 
    {   
        // Pega as mensagens de erro     
        $error_messages = $validator->errors()->all();

        // Exibe os parâmetros de erro
        throw new HttpResponseException(
        response()->json(
            [
                'success' => false,
                'error' => $error_messages[0],
                'error_code' => \ApiErrors::REQUEST_FAILED,
                'error_messages' => $error_messages,
            ]
        ));
    }
}
