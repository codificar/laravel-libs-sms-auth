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
			'user' => 'required'
		];
	}

	protected function prepareForValidation()
	{		
		$phone = $this->phone;
		$this->user = User::getByPhone($phone);
		$this->merge([
			'user' => $this->user
		]);
	}
	
	protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
        response()->json(
            [
                'success' => false,
                'errors' => $validator->errors()->all(),
                'error_code' => \ApiErrors::REQUEST_FAILED
            ]
        ));
    }
}
