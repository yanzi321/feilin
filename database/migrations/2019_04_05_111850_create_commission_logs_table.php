<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommissionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->comment('订单id');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->unsignedInteger('partner_id')->comment('合作者id');
            $table->unsignedDecimal('commission', 12, 2)->comment('佣金金额');
            $table->unsignedInteger('commission_rule_id')->comment('对应的佣金规则');
            $table->text('commission_rule_snapshot')->comment('佣金规则快照');
            $table->boolean('is_extra')->default(false)->comment('是不是额外的奖励');
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
        Schema::dropIfExists('commission_logs');
    }
}
