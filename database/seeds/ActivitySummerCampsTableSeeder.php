<?php

use Illuminate\Database\Seeder;

class ActivitySummerCampsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 填充数据
        factory(\App\ActivitySummerCamp::class, 20)->create();
    }
}
