<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrganizationsTableAddFromInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->unsignedInteger('from')->nullable()->comment('来源');
            $table->unsignedInteger('from_id')->nullable()->comment('具体来源的 id');
            $table->text('qrcode_link')->nullable()->comment('二维码信息，无用字段，为方便插入用的');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            //
        });
    }
}
