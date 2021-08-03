<?php

use Illuminate\Database\Seeder;

class ConsultLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 填充数据
        factory(\App\ConsultLog::class, 10)->create();
    }
}
