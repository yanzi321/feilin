<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterConsultLogsTableAddActivitySUmmerCampsId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consult_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('activity_summer_camp_id')->index()->comment('报名记录id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consult_logs', function (Blueprint $table) {
            //
        });
    }
}
