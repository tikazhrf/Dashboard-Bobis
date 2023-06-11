<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class UserManagementController extends Controller
{
    public function usermanagement()
    {
        return view('layout.user-management.usermanagement');
    }

    public function deleteuser($id)
    {
        $user = User::find($id);

        if (Auth::user()->role == 'Superadmin') {
            $user->delete();
            Alert::toast('Data akun berhasil dihapus!', 'warning')->persistent(false, false)->autoClose(3000);
            return redirect()->route('usermanagement');
        } else {
            Alert::toast('Oops, Anda Tidak Bisa Menghapus Data Ini!', 'error')->persistent(false, false)->autoClose(3000);
            return redirect()->route('usermanagement');
        }
    }
}
