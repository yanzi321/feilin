<?php

use Illuminate\Database\Seeder;

class PayLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 填充数据
        factory(\App\PayLog::class, 20)->create();
    }
}
