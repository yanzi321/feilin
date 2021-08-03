<?php

use Illuminate\Database\Seeder;

class ArticleTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 填充数据
        factory(\App\ArticleTag::class, 100)->create();
    }
}
