<?php

namespace App\Http\Controllers;

use App\Models\BusStops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class BusStopsController extends Controller
{
    public function busstops()
    {
        $data = BusStops::paginate('10');
        return view('layout.busstops.busstops', compact('data'));
    }

    public function tambahbusstops()
    {

        return view('layout.busstops.tambahbusstops');
    }

    public function insertbusstops(Request $request)
    {
        $data = BusStops::create($request->all());
        Alert::toast('Berhasil menambahkan data bus stops!', 'success')->persistent(false, false)->autoClose(3000);
        return Redirect()->route('busstops', compact('data'));
    }

    public function tampilbusstops($id)
    {
        $data = BusStops::find($id);
        //dd($data);

        return view('layout.busstops.tampilbusstops', compact('data'));
    }

    public function updatebusstops(Request $request, $id)
    {
        $data = BusStops::find($id);

        $data->update($request->all());
        return redirect()->route('busstops')->with('success', 'Bus Stops successfully updated');
    }


    public function deletebusstops($id)
    {
        $data = BusStops::find($id);
        if (Auth::user()->role == 'Superadmin' || Auth::user()->role == 'managementPO') {
            $data->delete();
            Alert::toast('Data bus stops berhasil dihapus!', 'warning')->persistent(false, false)->autoClose(3000);
            return redirect()->route('busstops');
        } else {
            Alert::toast('Oops, Anda Tidak Bisa Menghapus Data Ini!', 'error')->persistent(false, false)->autoClose(3000);
            return redirect()->route('busstops');
        }
    }
}
