<?php

namespace Database\Seeders;

use App\Models\BusStops;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusStopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BusStops::create([
            'bus_stops' => 'PENS',
            'latitude' => -7.275828468439012,
            'longitude' => 112.79375569473468
        ]);

        BusStops::create([
            'bus_stops' => 'UNESA',
            'latitude' => -7.315143473519831,
            'longitude' => 112.72721632379303
        ]);
    }
}
