<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ranks')->insert([
            ['title' => 'Herald'],
            ['title' => 'Guardian'],
            ['title' => 'Crusader'],
            ['title' => 'Archon'],
            ['title' => 'Legend'],
            ['title' => 'Ancient'],
            ['title' => 'Divine'],
            ['title' => 'Immortal']
        ]);
    }
}
