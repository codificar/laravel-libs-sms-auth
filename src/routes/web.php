<?php

//Rota de tema personalizado

use Codificar\Sms\SmsController;


Route::group(['prefix' => '/api/v1/sms'], function () {
    Route::get('request', SmsController::class . '@requestLogin');
    Route::get('login', SmsController::class . '@login');
});