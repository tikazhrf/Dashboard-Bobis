<?php

namespace App\Http\Controllers;

use App\Models\BusStops;
use Illuminate\Http\Request;

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
        return Redirect()->route('busstops', compact('data'))->with('success', 'Bus Stops successfully added');
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
        $data->delete();

        return redirect()->route('busstops')->with('success', 'Bus Stops successfully deleted');
    }
}
