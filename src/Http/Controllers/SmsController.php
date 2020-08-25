<?php

namespace Codificar\Sms;

use App\Http\Controllers\Controller;
use Codificar\Sms\Http\Requests\RequestSmsLoginFormRequest;
use Codificar\Sms\Http\Requests\SmsLoginFormRequest;
use Codificar\Sms\Http\Resources\SmsLoginResource;
use Codificar\Sms\Http\Resources\RequestSmsLoginResource;
use SMS;
use Codificar\Sms\Models\SmsCode;

class SmsController extends Controller
{
	/**
	 * Cria um código e o envia para o número informado, que poderá ser usado para login ou cadastro
	 * @param phone O telefone
	 * @return provider_id
	 */
	public function requestLogin(RequestSmsLoginFormRequest $request)
	{
		$code = SmsCode::makeSmsCode($request->phone);
		$this->send($request->phone, $code);

		return new RequestSmsLoginResource(['provider' => $request->provider]);
	}

	/**
	 * Compara o códido enviado com o código recebido e faz login
	 * @param code
	 * @param provider_id
	 * @return ProviderLoginController
	 */
	public function login(SmsLoginFormRequest $request)
	{
		return new SmsLoginResource(['request' => $request]);
	}

	//Envia o código
	private function send($phone, $code)
	{
		if(env('SMS_DRIVER') == 'twillo'){
			sendTwilloSms($phone, $code);
		} else {
			$msg = [
				'to'      => $phone,
				'content' => $code,
			];
			SMS::send($msg);
		}
	}
}
