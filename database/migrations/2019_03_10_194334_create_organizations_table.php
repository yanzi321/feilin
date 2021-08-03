<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->comment('结构名称');
            $table->string('logo')->nullable()->comment('logo');
            $table->text('images')->nullable()->comment('图片，多个图片');
            $table->string('description')->nullable()->comment('机构简介');
            $table->text('content')->comment('机构详情');
            $table->string('url')->nullable()->comment('官网URL链接');
            $table->integer('sort')->default(999)->comment('排序，值越小排序越靠前');
            $table->boolean('status')->default(true)->comment('状态');
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
        Schema::dropIfExists('organizations');
    }
}
