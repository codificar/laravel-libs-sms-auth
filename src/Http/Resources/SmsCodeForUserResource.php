<?php

namespace Codificar\Sms\Http\Resources;

use Codificar\Sms\Models\SmsCode;
use Illuminate\Http\Resources\Json\JsonResource;

class SmsCodeForUserResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		$user = $this['user'];

		if($user) {
			return [
				'success'		=> true,
				'login'			=> true,
				'user_id'		=> $user->id,
				'code_duration'	=> SmsCode::duration,
			];
		} else {
			return [
				'success'		=> true,
				'login'			=> false,
				'code_duration'	=> SmsCode::duration,
			];
		}
	}
}
