<?php

use Illuminate\Database\Seeder;

class WechatUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 填充数据
        factory(\App\WechatUser::class, 50)->create();
    }
}
