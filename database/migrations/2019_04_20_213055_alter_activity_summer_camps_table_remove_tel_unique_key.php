<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterActivitySummerCampsTableRemoveTelUniqueKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_summer_camps', function (Blueprint $table) {
            $table->dropUnique('activity_summer_camps_tel_unique');
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
            $table->unique('tel');
        });
    }
}
