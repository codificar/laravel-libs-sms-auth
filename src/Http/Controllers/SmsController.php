<?php

namespace Codificar\Sms\Http\Controllers;

use App\Http\Controllers\Controller;
use Codificar\Sms\Http\Requests\RequestSmsLoginFormRequest;
use Codificar\Sms\Http\Requests\SmsLoginFormRequest;
use Codificar\Sms\Http\Resources\SmsLoginResource;
use Codificar\Sms\Http\Resources\RequestSmsLoginResource;
use SMS;
use Codificar\Sms\Models\SmsCode;
use Settings;

class SmsController extends Controller
{
	/**
	 * Creates a code and sends it to the number entered, which can be used for login or registration
	 * @param RequestSmsLoginFormRequest $request
	 * @return RequestSmsLoginResource
	 */
	public function requestLogin(RequestSmsLoginFormRequest $request)
	{
		$code = SmsCode::makeSmsCode($request->phone);
		$project_name = Settings::findByKey("website_title");
		$this->send($request->phone, "Seu código " . $project_name . ": " . $code);

		return new RequestSmsLoginResource(['provider' => $request->provider]);
	}

	/**
	 * Compares the code sent with the code received and log in
	 * @param SmsLoginFormRequest $request
	 * @return SmsLoginResource
	 */
	public function login(SmsLoginFormRequest $request)
	{
		return new SmsLoginResource(['request' => $request]);
	}

	/**
	 * Send a code to phone
	 * @param string $phone
	 * @param int    $code  5 digit code
	 */
	private function send($phone, $code)
	{
		// if(env('SMS_DRIVER') == 'twilio'){
			sendTwilloSms($phone, $code);
		// } else {
		// 	$msg = [
		// 		'to'      => $phone,
		// 		'content' => $code,
		// 	];
		// 	SMS::send($msg);
		// }
	}
}
