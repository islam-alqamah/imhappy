<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('point_id')->nullable();
            $table->string('theme_color')->default('#0098a3')->nullable();
            $table->string('rate_label')->default('Please rate for us')->nullable();
            $table->string('submit_text')->default('Send Now')->nullable();
            $table->string('fields')->default('{email:yes},{feedback:no}')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback_forms');
    }
}
