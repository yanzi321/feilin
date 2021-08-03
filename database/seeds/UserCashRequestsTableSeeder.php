<?php

use Illuminate\Database\Seeder;

class UserCashRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 填充数据
        factory(\App\UserCashRequest::class, 50)->create();
    }
}
