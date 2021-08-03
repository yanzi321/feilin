<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_sn', 20)->comment('订单编号');
            $table->unsignedInteger('user_id')->comment('订单用户');
            $table->unsignedInteger('product_id')->comment('订单产品');
            $table->text('product_snapshot')->comment('产品快照');
            $table->unsignedTinyInteger('from');
            $table->unsignedInteger('from_id');
            $table->string('wants_country', 20)->comment('意向国家');
            $table->unsignedDecimal('commission', 10, 2)->comment('佣金比例，如 12.34%，储存为 1234');
            $table->unsignedDecimal('total_fee', 12, 2)->comment('总费用');
            $table->unsignedDecimal('left_fee', 12, 2)->comment('剩余金额');
            $table->unsignedDecimal('paid_fee', 12, 2)->comment('已付金额');
            $table->text('remark')->nullable()->comment('订单备注');
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
        Schema::dropIfExists('orders');
    }
}
