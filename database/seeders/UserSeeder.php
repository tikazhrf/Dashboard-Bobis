<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([ 
            'first_name' => 'Tika',   
            'last_name' => ' Azahra',
            'email' => 'tikazhrf15@gmail.com',
            'password' => 'Tikazhrf15',
            'password_confirm' => 'Tikazhrf15',
            'role' => 'managementPO',
            'image' => 'logo_bobus.png',
            'notelp' => '085607832167',
            'address' => 'Jl.Romokalisari',
        ]);

    }
}
