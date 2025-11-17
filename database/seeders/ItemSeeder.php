<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    public function run()
    {
        DB::table('items')->insert([
            [
                'branch_id' => 1, 
                'name' => 'PS 4',
                'type' => 'PS4',
                'hourly_rate' => 10000,
                'daily_rate' => 70000,
                'status' => 'available',
            ],
            [
                'branch_id' => 2,
                'name' => 'PS 5',
                'type' => 'PS5',
                'hourly_rate' => 15000,
                'daily_rate' => 90000,
                'status' => 'available',
            ],
        ]);
    }
}
