<?php

use Illuminate\Database\Seeder;

class PieceModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mock = [
            'name' => '首页banner',
            'description' => '首页 banner 的碎片模型',
            'fields' => \json_encode([
                ['name' => 'url', 'type' => 'url', 'description' => 'banner图片地址'],
                ['name' => 'title1', 'type' => 'text', 'description' => 'banner一级标题'],
                ['name' => 'title2', 'type' => 'text', 'description' => 'banner图二级标题'],
            ])
        ];

        \App\PieceModel::create($mock);


        $mock = [
            'name' => '产品介绍',
            'description' => '着陆页产品介绍模型',
            'fields' => \json_encode([
                ['name' => 'url1', 'type' => 'url', 'description' => '默认图片地址'],
                ['name' => 'url2', 'type' => 'url', 'description' => '悬浮图片地址'],
                ['name' => 'title1', 'type' => 'text', 'description' => 'banner一级标题'],
                ['name' => 'title2', 'type' => 'text', 'description' => 'banner图二级标题'],
            ])
        ];

        \App\PieceModel::create($mock);
    }
}
