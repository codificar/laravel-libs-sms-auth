<?php

namespace Codificar\Sms\Http\Requests;

use Provider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Codificar\Sms\Models\SmsCode;

class SmsLoginFormRequest extends FormRequest
{
	public $provider, $sms_code;

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
			'code' => 'required',
			'provider_id' => 'required'
		];
	}

	protected function prepareForValidation()
	{
		$this->provider = Provider::find($this->provider_id);
		$this->sms_code = SmsCode::getByPhone($this->provider ? $this->provider->phone : null);
		$this->merge([
			'provider' => $this->provider,
			'sms_code' => $this->sms_code
		]);
	}
}
