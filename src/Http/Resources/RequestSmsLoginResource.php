<?php

namespace Codificar\Sms\Http\Resources;

use Codificar\Sms\Models\SmsCode;
use Illuminate\Http\Resources\Json\JsonResource;


class RequestSmsLoginResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request)
	{
		$provider = $this['provider'];
		if($provider) {
			return [
				'success' => true,
				'login' => true,
				'provider_id' => $provider->id,
				'code_duration' => SmsCode::duration,
			];
		} else {
			return [
				'success' => true,
				'login' => false,
				'code_duration' => SmsCode::duration,
			];
		}
	}
}
