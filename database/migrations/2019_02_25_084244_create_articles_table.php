<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->comment('所属分类');
            $table->string('author')->comment('作者');
            $table->string('title')->comment('文章标题');
            $table->string('description')->comment('文章简介');
            $table->string('cover')->comment('文章封面');
            $table->longText('content')->comment('文章内容');
            $table->boolean('status')->default(false)->comment('文章状态');
            $table->integer('sort')->default(999)->comment('排序，值越小排序越靠前');
            $table->dateTime('published_at')->comment('发布时间');
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
        Schema::dropIfExists('articles');
    }
}
