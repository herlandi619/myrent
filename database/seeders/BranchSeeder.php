<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    public function run()
    {
        DB::table('branches')->insert([
            [
                'name' => 'TripleA Bintaro',
                'address' => 'Bintaro, Tangerang Selatan',
            ],
            [
                'name' => 'TripleA Pamulang',
                'address' => 'Pamulang, Tangerang Selatan',
            ],
        ]);
    }
}
