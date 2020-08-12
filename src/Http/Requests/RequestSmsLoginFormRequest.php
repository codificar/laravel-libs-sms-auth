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
			'phone' => 'required'
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
}
