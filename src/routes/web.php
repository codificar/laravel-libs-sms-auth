<?php

//Rota de tema personalizado

use Codificar\Sms\SmsController;


Route::group(['namespace' => 'api\v1', 'prefix' => '/api/v1/sms'], function () {
    Route::get('request', SmsController::class . '@requestLogin');
    Route::get('login', SmsController::class . '@login');
});