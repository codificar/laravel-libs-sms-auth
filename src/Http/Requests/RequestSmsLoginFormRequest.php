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
