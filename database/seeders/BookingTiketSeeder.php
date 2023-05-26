<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingTiketSeeder extends Seeder
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
            'code_bus' => '1C',
            'vin' => '392whjd28',
            'plate_number' => 'L8976WH',
            'bpkb_expired' => '2023/10/12',
            'driver' => 'Suprapto',
            'seat' => '30'
        ]);

        DB::table('rutes')->insert([
            'code_bus' => '2A',
            'origin' => 'Purabaya',
            'destination' => 'Rajawali',
            'price' => '10000'
        ]);

        DB::table('jadwals')->insert([
            'code_bus' => '1B',
            'origin' => 'ITS',
            'destination' => 'UNAIR',
            'start_at' => '08:00',
            'end_at' => '20:00',
            'duration_journey' => '10m',
            'operation_day' => 'Monday'
        ]);
        
    }
}
