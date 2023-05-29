<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert(['name' => 'New']);
        DB::table('statuses')->insert(['name' => 'Working']);
        DB::table('statuses')->insert(['name' => 'Done']);
        DB::table('statuses')->insert(['name' => 'Closed']);
    }
}
