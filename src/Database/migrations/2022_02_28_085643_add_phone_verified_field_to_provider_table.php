<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneVerifiedFieldToProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('provider', 'phone_verified')) {
            Schema::table('provider', function (Blueprint $table) {
                $table->boolean('phone_verified')->after('phone')->default(false);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provider', function (Blueprint $table) {
			$table->dropColumn('phone_verified');
        });
    }
}
