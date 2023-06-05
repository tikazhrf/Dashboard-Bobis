<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Jadwal;
use App\Models\Rute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function jadwal(Request $request)
    {

        $user = Auth::user();
        $company_id = $user->company_id;
        if ($request->has('search')) {
            $data = Bus::where('code_bus', 'LIKE', '%' . $request->search . '%')->paginate(10);
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = Bus::where('company_id', $company_id)->paginate(10);
            Session::put('halaman_url', request()->fullUrl());
        }
        //dd($data);
        return view('layout.jadwal.jadwal', compact('data'));
    }

    public function tambahjadwal()
    {
        $data = Bus::all();
        $data1 = Rute::all();
        return view('layout.jadwal.tambahjadwal', compact('data', 'data1'));
    }

    public function insertjadwal(Request $request)
    {
        //dd($request->all());

        if (!empty($request->input('operation_day'))) {
            $input = $request->all();
            $input['operation_day'] = $request->input('operation_day');
        } else {
            $input = '';
        }
        Jadwal::create($input);

        return redirect()->route('jadwal')->with('success3', 'Schedule successfully added');
    }

    public function tampiljadwal($id)
    {
        $data = Jadwal::find($id);
        $data1 = Bus::all();
        $data2 = Rute::all();
        //dd($data);

        return view('layout.jadwal.tampiljadwal', compact('data', 'data1', 'data2'));
    }

    public function updatejadwal(Request $request, $id)
    {
        $data = Jadwal::find($id);
        $data->update($request->all());

        return redirect()->route('jadwal')->with('success3', 'Schedule successfully updated');
    }

    public function deletejadwal($id)
    {
        $data = Jadwal::find($id);
        $data->delete();

        return redirect()->route('jadwal')->with('success3', 'Schedule successfully deleted');
    }
}
