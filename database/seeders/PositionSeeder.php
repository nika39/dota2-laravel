<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            ['title' => 'Safe Lane', 'position' => 1],
            ['title' => 'Mid Lane', 'position' => 2],
            ['title' => 'Off Lane', 'position' => 3],
            ['title' => 'Soft Support', 'position' => 4],
            ['title' => 'Hard Support', 'position' => 5],
        ]);
    }
}
