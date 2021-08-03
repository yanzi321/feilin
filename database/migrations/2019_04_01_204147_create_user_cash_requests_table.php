<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCashRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cash_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->string('name', 50)->comment('姓名');
            $table->string('tel', 20)->comment('电话');
            $table->unsignedTinyInteger('cash_way')->comment('提现方式：1、支付宝 2、银行卡');
            $table->string('alipay_account')->nullable()->comment('支付宝账号');
            $table->string('bank_name')->nullable()->comment('银行');
            $table->string('branch_name')->nullable()->comment('支行名称');
            $table->string('card_number')->nullable()->comment('银行卡号信息');
            $table->unsignedDecimal('cash_amount', 12, 2)->comment('体现金额');
            $table->tinyInteger('status')->comment('体现状态：0 未审核  1 处理中 2 已审核 3 审核失败');
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
        Schema::dropIfExists('user_cash_requests');
    }
}
