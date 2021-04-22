<?php

//Rota de tema personalizado

use Codificar\Sms\Http\Controllers\SmsController;


Route::group(['prefix' => '/api/v1/sms'], function () {

	/**
	 * @OA\Post(path="/api/v1/sms/request",
	 *      tags={"provider"},
	 *      operationId="request_sms",
	 *      description="Request an sms code to login or register",
	 *      @OA\Parameter(name="phone",
	 *          description="Phone to send code",
	 *          in="query",
	 *          required=true,
	 *          @OA\Schema(type="string")
	 *      ),
	 *      @OA\Response(response="200",
	 *          description="Resource referral",
	 *          @OA\JsonContent(ref="#/components/schemas/RequestSmsLoginResource")
	 *      ),
	 *      @OA\Response(
	 *          response="402",
	 *          description="Form request validation error. Invalid input."
	 *      ),
	 * )
	 */
	Route::get('request', SmsController::class . '@requestLogin');

	/**
	 * @OA\Post(path="/api/v1/sms/login",
	 *      tags={"provider"},
	 *      operationId="login_sms",
	 *      description="Login with SMS",
	 *      @OA\Parameter(name="code",
	 *          description="Code received by SMS",
	 *          in="query",
	 *          required=true,
	 *          @OA\Schema(type="string")
	 *      ),
	 *      @OA\Parameter(name="provider_id",
	 *          description="Provider's Id",
	 *          in="query",
	 *          required=true,
	 *          @OA\Schema(type="integer")
	 *      ),
	 *      @OA\Response(response="200",
	 *          description="Provider login",
	 *          @OA\JsonContent(ref="#/components/schemas/ProviderLoginResource")
	 *      ),
	 *      @OA\Response(
	 *          response="402",
	 *          description="Form request validation error. Invalid input."
	 *      ),
	 * )
	 */
	Route::get('login', SmsController::class . '@login');

	Route::post('request_sms_code_for_user', array('as' => 'RequestSmsCodeForUser', 'uses' => 'Codificar\Sms\Http\Controllers\SmsController@requestSmsCodeForUser'));
	Route::post('user_login_by_sms_code', array('as' => 'UserLoginBySmsCode', 'uses' => 'Codificar\Sms\Http\Controllers\SmsController@userLogin'));
});