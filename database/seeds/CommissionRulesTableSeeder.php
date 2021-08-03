<?php

use Illuminate\Database\Seeder;

class CommissionRulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        \DB::table('commission_rules')->insert([
            ['stage' => 1, 'max_number' => 5, 'commission' => 5000, 'created_at' => $now, 'updated_at' => $now],
            ['stage' => 2, 'max_number' => 10, 'commission' => 6000, 'created_at' => $now, 'updated_at' => $now],
            ['stage' => 3, 'max_number' => 15, 'commission' => 7000, 'created_at' => $now, 'updated_at' => $now],
            ['stage' => 4, 'max_number' => 99999, 'commission' => 8000, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
