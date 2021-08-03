<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insertArr = [
            [ 'name' => 'super-admin', 'display_name' => '超级管理员', 'created_at' => now(), 'updated_at' => now()],
            [ 'name' => 'admin', 'display_name' => '管理员', 'created_at' => now(), 'updated_at' => now()],
            [ 'name' => 'editor', 'display_name' => '编辑', 'created_at' => now(), 'updated_at' => now()],
            [ 'name' => 'salesman', 'display_name' => '业务员', 'created_at' => now(), 'updated_at' => now()],
            [ 'name' => 'accountant', 'display_name' => '会计', 'created_at' => now(), 'updated_at' => now()],
            [ 'name' => 'guest', 'display_name' => '访客', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('roles')->insert($insertArr);
    }
}
