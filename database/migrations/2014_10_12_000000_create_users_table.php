<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('学生姓名');
            $table->string('email')->nullable()->unique();

            // 自定义的一些字段哦~
            $table->dateTime('consult_at')->nullable()->comment('咨询时间');
            $table->string('avatar')->nullable()->comment('头像');
            $table->unsignedTinyInteger('sex')->nullable()->default(3)->comment('性别：1 男 2 女 3 其他');
            $table->unsignedTinyInteger('age')->nullable()->default(0)->comment('年龄');
            $table->unsignedTinyInteger('grade')->nullable()->default(0)->comment('所在年级');
            $table->string('school')->default('')->nullable()->comment('所在学校');
            $table->string('wants_country')->default('')->nullable()->comment('意向国家，使用国家简写保存');
            $table->string('language_level')->default('')->nullable()->comment('语言成绩');
            $table->string('parent_name')->default('')->nullable()->comment('父母姓名');
            $table->string('parent_tel')->default('')->nullable()->comment('父母电话');
            $table->string('wechat')->default('')->nullable()->comment('微信');
            $table->unsignedTinyInteger('from')->default(0)->nullable()->comment('用户来源 默认为自有来源');
            $table->unsignedInteger('from_id')->default(0)->nullable()->comment('用户来源id');
            $table->boolean('status')->default(1)->comment('账号状态，默认为开启');

            // 合作伙伴相关
            $table->boolean('is_partner')->default(false)->comment('是否是合作伙伴');
            $table->string('real_name', 20)->nullable()->comment('真实姓名');
            $table->string('tel', 20)->unique()->nullable()->comment('手机号');

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
