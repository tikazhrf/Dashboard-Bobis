<?php

namespace App\Http\Controllers;

use App\Models\DetailManagement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use function PHPUnit\Framework\returnSelf;

class LoginController extends Controller
{
    public function login(){
        return view('partials.login');
    }

    public function loginproses(Request $request){
        if(Auth::attempt($request->only('email', 'password'))) {
            return redirect('/');
        }

        return redirect('login');
        //dd($request->all());
    }

    public function register(){
        return view('partials.register');
    }

    public function registeruser(Request $request){
        //dd($request->all());
        User::create( [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'password_confirm' => bcrypt($request->password_confirm),
            'remember_token' => Str::random(60),
        ]);

        return redirect('/login');
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }

    public function detailmanagement() {

        $data = User::all();
        //dd($data);
        return view('layout.user-management.detailmanagement', compact('data'));
    }

    public function tampilmanagement($id) {

        $data = User::find($id);
        //dd($data);
        
        return view('layout.user-management.tampilmanagement', compact('data'));
    }

}
