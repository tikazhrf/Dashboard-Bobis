<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class BusController extends Controller
{
    public function databus(Request $request)
    {
        $user = Auth::user();

        if ($request->has('search')) {
            $data = Bus::where('code_bus', 'LIKE', '%' . $request->search . '%')->paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        } else {
            if ($user->role == 'Superadmin') {
                $data = Bus::paginate(5);
                Session::put('halaman_url', request()->fullUrl());
            } else {
                $company_id = $user->company_id;
                $data = Bus::where('company_id', $company_id)->paginate(5);
                Session::put('halaman_url', request()->fullUrl());
            }
        }

        //dd($data);
        return view('layout.bus.databus', compact('data'));
    }

    public function tambahbus()
    {
        $companies = Company::all();
        return view('layout.bus.tambahbus', compact('companies'));
    }

    public function insertbus(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'vin' => 'required|min:17|max:17',
            'plate_number' => 'required|min:5|max:8',
            'driver' => 'required|min:3|max:20'
        ]);

        $bus = new Bus();
        $bus->code_bus = $request->code_bus;
        $bus->vin = $request->vin;
        $bus->plate_number = $request->plate_number;
        $bus->bpkb_expired = $request->bpkb_expired;
        $bus->driver = $request->driver;
        $bus->jadwals_id = 1;
        $bus->total_seats = $request->total_seats;
        $bus->company = $request->company;
        $bus->company_id = Auth::user()->company_id;
        $bus->save();
        if ($request->hasFile('image')) {
            $request->file('image')->move('busimage/', $request->file('image')->getClientOriginalName());
            $bus->image = $request->file('image')->getClientOriginalName();
            $bus->save();
        }
        return redirect()->route('databus')->with('success', 'Data bus successfully added');
    }

    public function tampilbus($id)
    {
        $data = Bus::find($id);
        //dd($data);

        return view('layout.bus.tampilbus', compact('data'));
    }

    public function updatebus(Request $request, $id)
    {
        $data = Bus::find($id);
        $data->update($request->all());
        if (session('halaman_url')) {
            return redirect(session('halaman_url'))->with('success', 'Data bus successfully updated');
        }

        if ($request->hasFile('image')) {
            $request->file('image')->move('busimage/', $request->file('image')->getClientOriginalName());
            $data->image = $request->file('image')->getClientOriginalName();
            $data->save();
        }

        return redirect()->route('databus')->with('success', 'Data bus successfully updated');
    }

    public function deletebus($id)
    {
        $data = Bus::find($id);
        if (Auth::user()->role == 'Superadmin' || Auth::user()->role == 'managementPO') {
            $data->delete();
            Alert::toast('Data bus berhasil dihapus!', 'warning')->persistent(false, false)->autoClose(3000);
            return redirect()->route('databus');
        } else {
            Alert::toast('Oops, Anda Tidak Bisa Menghapus Data Ini!', 'error')->persistent(false, false)->autoClose(3000);
            return redirect()->route('databus');
        }
    }
}
