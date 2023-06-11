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
        $transaction = count(Transaction::all());
        $paid = Transaction::where('status', 'Paid')->count();
        $unpaid = Transaction::where('status', 'Unpaid')->count();
        $pending = Transaction::where('status', 'Pending')->count();
        $totalAkun = User::where('company_id', Auth::user()->company_id)->count();
        $companies = Company::pluck('company_name');
        $totalBalance = Transaction::where('status', 'paid')->sum('total_price');
        $today = Carbon::now()->format('l');

        $buses = Bus::join('jadwals', 'buses.jadwals_id', '=', 'jadwals.id')
            ->where('jadwals.operation_day', 'like', '%"' . $today . '"%')
            ->get();

        $tiketTersedia = [];

        $tiketTersedia = [];

        foreach ($buses as $bus) {
            $jumlahTiketTerjual = BookingTiket::where('buses_id', $bus->id)->count();
            $jumlahTiketTersedia = $bus->total_seats - $jumlahTiketTerjual;
            if ($jumlahTiketTersedia > 0) {
                $tiketTersedia[] = [
                    'bus_id' => $bus->id,
                    'code_bus' => $bus->code_bus,
                    'company_name' => $bus->company->company_name,
                    'jumlah_tersedia' => $jumlahTiketTersedia
                ];
            }
        }

        $tiketTerjual = [];

        foreach ($companies as $company) {
            $tiketTerjual[] = BookingTiket::whereHas('buses.company', function ($query) use ($company) {
                $query->where('company_name', $company);
            })->count();
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
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_id' => $request->company,
            'email' => $request->email,
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

    public function detailmanagement()
    {
        $data = User::all()->where('role', 'managementPO');
        return view('layout.user-management.detailmanagement', compact('data'));
    }

    public function detaildriver()
    {
        $data = User::all()->where('role', 'Driver');
        return view('layout.user-management.detaildriver', compact('data'));
    }

    public function detailuser()
    {
        $data = User::all()->where('role', 'user');
        return view('layout.user-management.detailuser', compact('data'));
    }

    public function tampilmanagement($id)
    {
        $data = User::find($id);
        return view('layout.user-management.tampilmanagement', compact('data'));
    }
}
