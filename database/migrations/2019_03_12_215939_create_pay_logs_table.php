<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admin_id')->comment('操作人员');
            $table->unsignedInteger('order_id')->comment('对应订单');
            $table->unsignedDecimal('paid_fee')->comment('缴费金额');
            $table->dateTime('paid_at')->comment('缴费时间');
            $table->string('remark')->nullable()->comment('缴费备注');
            $table->boolean('status')->default(true)->comment('预留字段');
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
        Schema::dropIfExists('pay_logs');
    }
}
