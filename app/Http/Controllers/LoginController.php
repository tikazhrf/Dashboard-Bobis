<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\DetailManagement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use function PHPUnit\Framework\returnSelf;

class LoginController extends Controller
{
    public function index()
    {
        return view('welcome');
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
