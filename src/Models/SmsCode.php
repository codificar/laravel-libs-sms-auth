<?php

namespace Codificar\Sms\Models;

use Illuminate\Database\Eloquent\Model;


class SmsCode extends Model
{

	protected $table = 'sms_code';
	protected $guarded = ['id'];
	public $timestamps = false;

	public const duration = 1440;  //1 dia

	public static function makeSmsCode($phone)
	{
		$model = self::getByPhone($phone);
		if (!$model) $model = new SmsCode(['phone' => $phone]);
		$model->code = self::generate_sms_code();
		$model->code_expiry = self::generate_expiry(self::duration);
		$model->save();
		return $model->code;
	}

	public static function getByPhone($phone)
	{
		return self::where('phone', 'like', $phone)
			->orWhere('phone', 'like', str_ireplace('+55', '', $phone))
			->orWhere('phone', 'like', '%' . $phone)
			->first();
	}

	public function validate($code)
	{
		return $this->code == $code and self::is_token_active($this->code_expiry);
	}


	static function generate_sms_code()
	{
		return  rand(10000, 99999);
	}


	static function generate_expiry($duration)
	{
		return time() + ($duration * 60);
	}

	public static function is_token_active($ts)
	{
		if ($ts >= time()) {
			return true;
		} else {
			return false;
		}
	}
}
