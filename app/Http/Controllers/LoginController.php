<?php

namespace App\Http\Controllers;

use App\Models\BookingTiket;
use App\Models\Bus;
use App\Models\Company;
use App\Models\DetailManagement;
use App\Models\Jadwal;
use App\Models\JenisTiket;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\returnSelf;

class LoginController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('l');

        if (Auth::user()->role == 'managementPO' || Auth::user()->role == 'Driver') {

            $transaction = Transaction::whereHas('bus.company', function ($query) {
                $query->where('id', Auth::user()->company_id);
            })->count();

            $paid = Transaction::where('status', 'Paid')->whereHas('bus.company', function ($query) {
                $query->where('id', Auth::user()->company_id);
            })->count();

            $unpaid = Transaction::where('status', 'Unpaid')->whereHas('bus.company', function ($query) {
                $query->where('id', Auth::user()->company_id);
            })->count();

            $pending = Transaction::where('status', 'Pending')->whereHas('bus.company', function ($query) {
                $query->where('id', Auth::user()->company_id);
            })->count();

            $totalBalance = Transaction::where('status', 'Paid')->whereHas('bus.company', function ($query) {
                $query->where('id', Auth::user()->company_id);
            })->sum('total_price');

            $companies = Company::where('id', Auth::user()->company_id)->pluck('company_name');

            $buses = Jadwal::join('buses', 'jadwals.buses_id', '=', 'buses.id')
                ->where('jadwals.operation_day', 'like', '%"' . $today . '"%')
                ->where('buses.company_id', Auth::user()->company_id)
                ->get();
        } else {
            $transaction = Transaction::all()->count();

            $paid = Transaction::where('status', 'Paid')->count();

            $unpaid = Transaction::where('status', 'Unpaid')->count();

            $pending = Transaction::where('status', 'Pending')->count();

            $companies = Company::pluck('company_name');

            $totalBalance = Transaction::where('status', 'Paid')->sum('total_price');

            $buses = Jadwal::join('buses', 'jadwals.buses_id', '=', 'buses.id')
                ->where('jadwals.operation_day', 'like', '%"' . $today . '"%')
                ->get();
        }


        if (Auth::user()->role == 'managementPO' || Auth::user()->role == 'Driver') {
            $totalAkun = User::where('company_id', Auth::user()->company_id)->count();
        } else {
            $totalAkun = User::all()->count();
        }

        $tiketTersedia = [];

        foreach ($buses as $bus) {
            $jumlahTiketTerjual = BookingTiket::where('buses_id', $bus->id)->count();
            $jumlahTiketTersedia = $bus->total_seats - $jumlahTiketTerjual;
            if ($jumlahTiketTersedia > 0) {
                $tiketTersedia[] = [
                    'bus_id' => $bus->id,
                    'code_bus' => $bus->buses->code_bus,
                    'company_name' => $bus->buses->company->company_name,
                    'jumlah_tersedia' => $jumlahTiketTersedia
                ];
            }
        }

        $tiketTerjual = [];

        foreach ($companies as $company) {
            if (Auth::user()->role == 'managementPO' || Auth::user()->role == 'Driver') {
                $jumlahTiketTerjual = BookingTiket::whereHas('buses.company', function ($query) use ($company) {
                    $query->where('company_name', $company)->where('id', Auth::user()->company_id);
                })->count();
            } else {
                $jumlahTiketTerjual = BookingTiket::whereHas('buses.company', function ($query) use ($company) {
                    $query->where('company_name', $company);
                })->count();
            }
            $tiketTerjual[] = $jumlahTiketTerjual;
        }


        return view('welcome', compact('totalAkun', 'transaction', 'companies', 'tiketTerjual', 'totalBalance', 'paid', 'unpaid', 'pending', 'buses', 'tiketTersedia'));
    }

    public function login()
    {
        return view('partials.login');
    }

    public function loginproses(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return redirect()->intended('login');
    }


    public function register()
    {
        $companies = Company::all();
        return view('partials.register', compact('companies'));
    }

    public function registeruser(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'agree' => 'required|accepted',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            // 'company_id' => $request->company,
            'email' => $request->email,
            'notelp' => $request->notelp,
            'address' => $request->address,
            'password' => bcrypt($request->password),
            'password_confirm' => bcrypt($request->password_confirm),
            'remember_token' => Str::random(60),
        ]);

        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
