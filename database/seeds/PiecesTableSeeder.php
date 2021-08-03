<?php

use Illuminate\Database\Seeder;

class PiecesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mock = [
            'piece_model_id' => 1,
            'name' => 'first banner',
            'sort' => 999,
            'status' => 1,
            'values' => '{"id":"1","name":"首页banner","description":"首页 banner 的碎片模型","fields":[{"name":"url","type":"url","description":"banner图片地址","value":"http:\/\/image1.com"},{"name":"title1","type":"text","description":"banner一级标题","value":"banner title1"},{"name":"title2","type":"text","description":"banner图二级标题","value":"banner title2"}]}'
        ];

        \App\Piece::create($mock);
    }
}
