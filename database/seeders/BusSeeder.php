<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buses')->insert([
            'image' => '6306447.jpg',
            'code_bus' => '1A',
            'vin' => '392whjd28',
            'plate_number' => 'L8976WH',
            'bpkb_expired' => '2023/10/12',
            'driver' => 'Suprapto',
            'total_seats' => '30',
            'company_id' => 1,
            'jadwals_id' => 1,
        ]);

        DB::table('buses')->insert([
            'image' => '6306447.jpg',
            'code_bus' => '2A',
            'vin' => '420qwer90',
            'plate_number' => 'W1238JR',
            'bpkb_expired' => '2025/10/12',
            'driver' => 'Yanto',
            'total_seats' => '28',
            'company_id' => 2,
            'jadwals_id' => 1,
        ]);
    }
}
