<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterActiviySummerCampsAddExternSalesmanId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_summer_camps', function (Blueprint $table) {
            $table->unsignedInteger('extern_salesman_id')->nullable()->comment('外部业务员id');
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
