<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterActiviySummerCampsAddOrganizationId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_summer_camps', function (Blueprint $table) {
            $table->unsignedInteger('organization_id')->nullable()->index()->comment('如果是机构推广，此处显示机构id');
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
