<?php

use Illuminate\Database\Seeder;

class ExternSalesmanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 填充数据
        factory(\App\ExternSalesman::class, 10)->create();
    }
}
