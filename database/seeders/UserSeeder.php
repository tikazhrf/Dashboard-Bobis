<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Tika',
            'last_name' => ' Azahra',
            'email' => 'tikazhrf15@gmail.com',
            'password' => Hash::make('Tikazhrf15'),
            'password_confirm' => Hash::make('Tikazhrf15'),
            'role' => 'managementPO',
            'image' => 'logo_bobus.png',
            'notelp' => '6285607832167',
            'address' => 'Jl.Romokalisari',
            'company_id' => 1
        ]);

        User::create([
            'first_name' => 'Azahra',
            'last_name' => ' Tika',
            'email' => 'azahra@gmail.com',
            'password' => Hash::make('azahra'),
            'password_confirm' => Hash::make('azahra'),
            'role' => 'Superadmin',
            'image' => 'logo_bobus.png',
            'notelp' => '6289765436782',
            'address' => 'Jl.Sariroti',
        ]);

        $pregnantUser = User::create([
            'first_name' => 'Shinta',
            'last_name' => 'Ramadhani',
            'email' => 'shinta@gmail.com',
            'status' => 'Ibu Hamil',
            'password' => Hash::make('shinta'),
            'password_confirm' => Hash::make('shinta'),
            'role' => 'user',
            'image' => 'logo_bobus.png',
            'notelp' => '628726281929',
            'address' => 'Jl.Merdeka',
            'pregnancy_start_date' => Carbon::now(),
        ]);

        // Mengisi end date dengan waktu 60 hari setelah start date
        $startDate = Carbon::parse($pregnantUser->pregnancy_start_date);
        $endDate = $startDate->copy()->addDays(60);

        $pregnantUser->pregnancy_start_date = $startDate->format('Y-m-d');
        $pregnantUser->pregnancy_end_date = $endDate->format('Y-m-d');
        $pregnantUser->save();

        // Memperbarui status pengguna setelah 60 hari
        $now = Carbon::now();

        if ($now->greaterThanOrEqualTo($endDate)) {
            $pregnantUser->pregnancy_start_date = null;
            $pregnantUser->pregnancy_end_date = null;
            $pregnantUser->status = 'Umum';
            $pregnantUser->save();
        }
    }
}
