<?php

namespace Codificar\Sms\Http\Resources;

use api\v1\ProviderLoginController;
use Illuminate\Http\Resources\Json\JsonResource;


class SmsLoginResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request)
	{
		$formRequest = $this['request'];
		if ($formRequest->sms_code->validate($formRequest->code)) {
			return ProviderLoginController::validateLogin($formRequest);
		} else {
			return [
				'success' => false,
				'error' => trans('provider.invalid_code')
			];
		}
	}
}
