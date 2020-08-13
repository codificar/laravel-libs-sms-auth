<?php

//Rota de tema personalizado

use Codificar\Sms\SmsController;


Route::group(['prefix' => '/api/v1/sms'], function () {

	/**
	 * @OA\Post(path="/api/v1/sms/request",
	 *      tags={"provider"},
	 *      operationId="request_sms",
	 *      description="Requisita um código sms para login ou cadastro",
	 *      @OA\Parameter(name="phone",
	 *          description="Telefone para enviar o código",
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
	 *      description="Faz login via sms",
	 *      @OA\Parameter(name="code",
	 *          description="Código recebido por sms",
	 *          in="query",
	 *          required=true,
	 *          @OA\Schema(type="string")
	 *      ),
	 *      @OA\Parameter(name="provider_id",
	 *          description="Id do motorista",
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
});