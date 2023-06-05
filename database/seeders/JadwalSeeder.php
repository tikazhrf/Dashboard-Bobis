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
            'start_at' => '08:00',
            'end_at' => '20:00',
            'operation_day' => json_encode(['Monday', 'Thursday', 'Wednesday', 'Friday', 'Saturday', 'Sunday']),
            'rutes_id' => 1
        ]);
    }
}
