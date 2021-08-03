<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_category_id');
            $table->string('name')->comment('产品名称');
            $table->unsignedDecimal('commission', 10, 2)->comment('佣金比例，如 12.34%，储存为 1234');
            $table->unsignedDecimal('price', 10, 2)->comment('价格，单位：分');
            $table->string('description')->nullable()->comment('产品描述');
            $table->longText('content')->nullable()->comment('详细内容');
            $table->integer('sort')->default(999)->comment('排序，值越小排序越靠前');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('products');
    }
}
