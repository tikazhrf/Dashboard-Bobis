<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusStops;
use App\Models\Rute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RuteController extends Controller
{
    public function rutebus(Request $request)
    {

        if ($request->has('search')) {
            $data = Rute::where('code_bus', 'LIKE', '%' . $request->search . '%')->paginate(10);
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = Rute::paginate(10);
            Session::put('halaman_url', request()->fullUrl());
        }
        $data = Bus::paginate(10);

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
        $data = Rute::find($id);
        $data1 = Bus::all();
        $datarute = BusStops::all();
        //dd($data);

        return view('layout.rute.tampilrute', compact('data', 'data1', 'datarute'));
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
        $data->delete();

        return redirect()->route('rutebus')->with('success', 'Route successfully deleted');
    }
}
