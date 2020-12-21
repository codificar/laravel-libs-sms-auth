<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsCodesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sms_code', function (Blueprint $table) {
			$table->increments('id');
			$table->string('phone')->unique();
			$table->string('code');
			$table->integer('code_expiry');
		});

		Schema::table('provider', function (Blueprint $table) {
			$table->boolean('phone_verified')->after('phone')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('sms_code');
		Schema::table('provider', function (Blueprint $table) {
			$table->dropColumn('phone_verified');
		});
	}
}
