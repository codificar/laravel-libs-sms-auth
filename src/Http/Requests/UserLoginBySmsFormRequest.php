<?php

namespace Codificar\Sms\Http\Requests;

use Provider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Codificar\Sms\Models\SmsCode;
use User;

class UserLoginBySmsFormRequest extends FormRequest
{
	public $user, $sms_code;

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
			'code' 		=> 'required',
			'user_id'	=> 'required'
		];
	}

	protected function prepareForValidation()
	{
		$this->user = User::find($this->user_id);
		$this->sms_code = SmsCode::getByPhone($this->user ? $this->user->phone : null);

		$this->merge([
			'user' => $this->user,
			'sms_code' => $this->sms_code
		]);
	}
}
