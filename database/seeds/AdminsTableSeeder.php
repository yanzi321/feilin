<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'boss',
            'tel' => '1388888888',
            'job_number' => '888888',
            'email' => 'boss@app.com',
            'password' => \Illuminate\Support\Facades\Hash::make('bossPassword')
        ];

        $admin = \App\Admin::create($data);

        $role = \App\Role::whereName('super-admin')->first();
        $admin->attachRole($role);

        $data = [
            'name' => 'user',
            'tel' => '',
            'job_number' => '',
            'email' => 'user@app.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password')
        ];
        $admin = \App\Admin::create($data);
        $role = \App\Role::whereName('guest')->first();
        $admin->attachRole($role);
    }
}
