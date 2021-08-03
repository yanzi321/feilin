<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommissionRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('stage')->comment('阶段');
            $table->unsignedInteger('max_number')->comment('当前阶段的最大人数');
            $table->unsignedDecimal('commission',12,2)->comment('佣金金额');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commission_rules');
    }
}
