<?php

namespace Codificar\Sms\Http\Resources;

use Codificar\Sms\Http\Resources\helpers\helper;

// use api\v1\ProviderLoginController;
use Illuminate\Http\Resources\Json\JsonResource;

use function Codificar\Sms\Http\Resources\helpers\login_helper;

class LoginBySmsForUserResource extends JsonResource
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
			// return ProviderLoginController::validateLogin($formRequest, true);
			return login_helper($formRequest, true);
		} else {
			return [
				'success' => false,
				'error' => trans('provider.invalid_code')
			];
		}
	}
}
