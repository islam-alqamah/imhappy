<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldTelegramTokenToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('team_settings', function (Blueprint $table) {

            $table->integer('response_time_delay')->after('telegram')
                ->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('team_settings', function (Blueprint $table) {
            $table->dropColumn('response_time_delay');
        });
    }
}
