<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternSalesmenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extern_salesmen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('姓名');
            $table->string('tel')->index()->comment('手机号');
            $table->unsignedInteger('from')->comment('来源');
            $table->unsignedInteger('from_id')->comment('具体来源的 id');
            $table->unsignedInteger('admin_id')->comment('哪个管理员添加的');
            $table->integer('sort')->default(999)->comment('排序，值越小排序越靠前');
            $table->boolean('status')->default(true)->comment('状态');
            $table->text('qrcode_link')->nullable()->comment('二维码信息，无用字段，为方便插入用的');
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
        Schema::dropIfExists('extern_salesmen');
    }
}
