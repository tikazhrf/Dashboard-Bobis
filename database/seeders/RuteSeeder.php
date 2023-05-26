<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rutes')->insert([
            'code_bus' => '1A',
            'origin' => 'Purabaya',
            'destination' => 'Rajawali',
            'price' => '10000'
        ]);
    }
}
