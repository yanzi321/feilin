<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiecesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pieces', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('piece_model_id');
            $table->string('name')->comment('碎片名称');
            $table->longText('values')->comment('碎片具体的内容');
            $table->integer('sort')->comment('排序，值越小排序越靠前');
            $table->boolean('status')->default(false)->comment('状态');
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
        Schema::dropIfExists('pieces');
    }
}
