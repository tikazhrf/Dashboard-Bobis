<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusStops;
use App\Models\Rute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;


class RuteController extends Controller
{
    public function rutebus(Request $request)
    {
        $user = Auth::user();

        if ($request->has('search')) {
            $data = Rute::paginate(10);
            Session::put('halaman_url', request()->fullUrl());
        } else {
            if ($user->role == 'Superadmin') {
                $data = Rute::paginate(10);
                Session::put('halaman_url', request()->fullUrl());
            } else {
                $company_id = $user->company_id;
                $data = Rute::paginate(10);
                Session::put('halaman_url', request()->fullUrl());
            }
        }

        return view('layout.rute.rutebus', compact('data'));
    }

    public function tambahrute()
    {

        $data = Bus::all();
        $datarute = BusStops::all();
        return view('layout.rute.tambahrute', compact('data', 'datarute'));
    }

    public function insertrute(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'price' => 'required|min:4|max:7',
        ]);

        Rute::create($request->all());
        return redirect()->route('rutebus')->with('success', 'Route bus successfully added');
    }

    public function tampilrute($id)
    {
        $data = Rute::join('jadwals', 'rutes.id', '=', 'jadwals.rutes_id')
            ->join('buses', 'jadwals.id', '=', 'buses.id')->find($id);
        $datarute = BusStops::all();

        return view('layout.rute.tampilrute', compact('data', 'datarute'));
    }

    public function updaterute(Request $request, $id)
    {
        $data = Rute::find($id);

        $data->update($request->all());
        if (session('halaman_url')) {
            return redirect(session('halaman_url'))->with('success', 'Data bus successfully updated');
        }

        return redirect()->route('rutebus')->with('success', 'Route successfully updated');
    }

    public function deleterute($id)
    {
        $data = Rute::find($id);
        if (Auth::user()->role == 'Superadmin' || Auth::user()->role == 'managementPO') {
            $data->delete();
            Alert::toast('Data rute berhasil dihapus!', 'warning')->persistent(false, false)->autoClose(3000);
            return redirect()->route('rutebus');
        } else {
            Alert::toast('Oops, Anda Tidak Bisa Menghapus Data Ini!', 'error')->persistent(false, false)->autoClose(3000);
            return redirect()->route('rutebus');
        }
    }
}
