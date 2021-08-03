<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterActivitySummerCampsTableAddUserInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_summer_camps', function (Blueprint $table) {
            $table->dateTime('consult_at')->nullable()->comment('咨询时间');
            $table->string('avatar')->nullable()->comment('头像');
            $table->string('place')->nullable()->comment('地区');
            $table->string('remark')->nullable()->comment('备注');
            $table->unsignedTinyInteger('sex')->nullable()->default(3)->comment('性别：1 男 2 女 3 其他');
            $table->unsignedTinyInteger('age')->nullable()->default(0)->comment('年龄');
            $table->unsignedTinyInteger('grade')->nullable()->default(0)->comment('所在年级');
            $table->string('school')->default('')->nullable()->comment('所在学校');
            $table->string('language_level')->default('')->nullable()->comment('语言成绩');
            $table->string('parent_name')->default('')->nullable()->comment('父母姓名');
            $table->string('parent_tel')->default('')->nullable()->comment('父母电话');
            $table->string('email')->default('')->nullable()->comment('邮箱');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_summer_camps', function (Blueprint $table) {
            //
        });
    }
}
