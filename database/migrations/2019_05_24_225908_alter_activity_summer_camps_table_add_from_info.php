<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterActivitySummerCampsTableAddFromInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_summer_camps', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable()->comment('报名用户的 user_id 呀');
            $table->unsignedInteger('from_id')->nullable()->comment('来源id');
            $table->string('from')->nullable()->comment('来源场景');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_summer_camps', function (Blueprint $table) {
            //
        });
    }
}
