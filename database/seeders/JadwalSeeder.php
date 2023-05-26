<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jadwals')->insert([
            'code_bus' => '1A',
            'origin' => 'ITS',
            'destination' => 'UNAIR',
            'start_at' => '08:00',
            'end_at' => '20:00',
            'duration_journey' => '10',
            'operation_day' => ['Monday', 'Thursday', 'Wednesday', 'Friday', 'Saturday', 'Sunday']
        ]);
    }
}
