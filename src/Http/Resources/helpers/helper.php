<?php

use Codificar\Sms\Models\SmsCode;
use Illuminate\Support\Facades\Hash;

function clean($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string = str_replace(' ', '.', $string);

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function generate_token()
{
    return clean(Hash::make(rand() . time() . rand()));
}

function provider_login_helper($request, $valid_sms = false)
{
    //pega os dados padroes
    $provider = $request->provider;
    $provider->device_type = $request->device_type;
    $provider->device_token = $request->device_token ? $request->device_token : 0;
    $provider->latitude = $request->latitude ? $request->latitude : 0;
    $provider->longitude = $request->longitude ? $request->longitude : 0;
    $provider->token = generate_token();
    $provider->token_expiry = SmsCode::generate_expiry($provider->token);

    if ($valid_sms) {
        $provider->phone_verified = true;
    }

    if ($request->social_unique_id) {
        $provider->social_unique_id = trim($request->social_unique_id);
        $provider->login_by = $request->login_by;
    }

    $provider->is_active = 1;

    $provider->save();

    return new Codificar\Sms\Http\Resources\RequestSmsLoginResource($provider);
}
