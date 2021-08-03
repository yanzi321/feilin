<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitySummerCampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_summer_camps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->comment('姓名');
            $table->string('tel', 20)->unique()->comment('电话');
            $table->string('wants_country', 20)->nullable()->comment('意向国家');
            $table->ipAddress('ip')->nullable()->comment('IP地址');
            $table->softDeletes();
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
        Schema::dropIfExists('activity_summer_camps');
    }
}
