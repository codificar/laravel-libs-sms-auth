<?php

namespace Codificar\Sms\Http\Resources;

use Codificar\Sms\Models\SmsCode;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RequestSmsLoginResource
 *
 * @package sms-auth
 *
 * @author  Álvaro Oliveira <alvaro.oliveira@codificar.com.br>
 *
 * @OA\Schema(
 *     schema="RequestSmsLoginResource",
 *     type="object",
 *     description="Login SMS response",
 *     title="Request Sms Login Resource",
 *     allOf={
 *       @OA\Schema(ref="#/components/schemas/RequestSmsLoginResource"),
 *       @OA\Schema(
 *          required={"success", "conversation", "users"},
 *          @OA\Property(property="success", format="boolean", type="boolean"),
 *          @OA\Property(property="login", type="boolean"),
 *          @OA\Property(property="provider_id", type="integer"),
 *          @OA\Property(property="code_duration", type="integer")
 *       )
 *     }
 * )
 */
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
