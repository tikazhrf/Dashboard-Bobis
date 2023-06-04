<?php

namespace Database\Seeders;

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
        DB::table('bus_stops')->insert([
            'bus_stops' => 'PENS',
        ]);

        DB::table('bus_stops')->insert([
            'bus_stops' => 'UNESA',
        ]);
    }
}
