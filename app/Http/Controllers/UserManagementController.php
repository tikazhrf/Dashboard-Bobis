<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class UserManagementController extends Controller
{
    public function usermanagement()
    {
        return view('layout.user-management.usermanagement');
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

    public function tambahakun()
    {
        return view('layout.user-management.tambahmanagement');
    }

    public function storeakun(Request $request)
    {
        $data = new User();
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->notelp = $request->notelp;
        $data->address = $request->address;
        $data->role = $request->role;
        $data->password = Hash::make($request->password);
        $data->password_confirm = Hash::make($request->password);
        $data->status = $request->status;
        $data->updated_at = Carbon::now();
        if ($data->status === 'Ibu Hamil') {
            $data->pregnancy_start_date = Carbon::now()->format('d F Y');
            $data->pregnancy_end_date = Carbon::now()->addDays(60)->format('d F Y');
        }

        $data->save();

        if ($data->role == 'managementPO') {
            Alert::toast('Berhasil menambah akun Management PO!', 'success')->persistent(false, false)->autoClose(3000);
            return redirect()->route('detailmanagement');
        } elseif ($data->role == 'Driver') {
            Alert::toast('Berhasil menambah akun Driver!', 'success')->persistent(false, false)->autoClose(3000);
            return redirect()->route('detaildriver');
        } elseif ($data->role == 'user') {
            Alert::toast('Berhasil menambah akun User!', 'success')->persistent(false, false)->autoClose(3000);
            return redirect()->route('detailuser');
        }
    }

    public function tampilmanagement($id)
    {
        $data = User::find($id);
        return view('layout.user-management.tampilmanagement', compact('data'));
    }

    public function updateUser(Request $request, $id)
    {
        $data = User::find($id);
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->notelp = $request->notelp;
        $data->address = $request->address;
        $data->role = $request->role;
        $data->status = $request->status;
        $data->image = $request->image;
        $data->updated_at = Carbon::now();
        if ($data->status === 'Ibu Hamil') {
            $data->pregnancy_start_date = Carbon::now()->format('d F Y');
            $data->pregnancy_end_date = Carbon::now()->addDays(60)->format('d F Y');
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('style/dist/assets/img/', $filename);
            $data->image = $filename;
        } else {
            // Jika request tidak memiliki file baru, ubah data file profil dengan menggunakan nama file baru dari request
            if ($request->image) {
                $filename = $request->image;

                $data->image = $filename;
            }
        }
        $data->save();

        Alert::toast('Data akun berhasil diubah!', 'success')->persistent(false, false)->autoClose(3000);
        if ($data->role == 'managementPO') {
            return redirect()->route('detailmanagement');
        } elseif ($data->role == 'Driver') {
            return redirect()->route('detaildriver');
        } elseif ($data->role == 'user') {
            return redirect()->route('detailuser');
        }
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
