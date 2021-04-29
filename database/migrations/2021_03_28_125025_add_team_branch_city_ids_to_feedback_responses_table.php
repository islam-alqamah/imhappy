<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeamBranchCityIdsToFeedbackResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feedback_responses', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable()->after('id');
            $table->unsignedBigInteger('city_id')->nullable()->after('team_id');
            $table->unsignedBigInteger('branch_id')->nullable()->after('city_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feedback_responses', function (Blueprint $table) {
            $table->dropColumn('team_id');
            $table->dropColumn('city_id');
            $table->dropColumn('branch_id');
        });
    }
}
