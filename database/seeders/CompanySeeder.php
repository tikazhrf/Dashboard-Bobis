<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company')->insert([
            'company_name' => 'Trans Jakarta'
        ]);

        DB::table('company')->insert([
            'company_name' => 'Harapan Jaya'
        ]);

        DB::table('company')->insert([
            'company_name' => 'Tiara Mas'
        ]);
    }
}
