<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BusController extends Controller
{
    public function databus(Request $request){

        if ($request->has('search')) {
            $data = Bus::where('code_bus','LIKE','%' .$request->search.'%')->paginate(10);
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = Bus::paginate(10);
            Session::put('halaman_url', request()->fullUrl());
        }

        //dd($data);
        return view('layout.bus.databus', compact('data'));
    }

    public function tambahbus(){
        return view('layout.bus.tambahbus');
    }

    public function insertbus(Request $request){
        //dd($request->all());

       $this->validate($request, [
        'vin' => 'required|min:17|max:17',
        'plate_number' => 'required|min:5|max:8',
        'driver' => 'required|min:3|max:20'
       ]);
       
        $data = Bus::create($request->all());
        if ($request->hasFile('image')) {
            $request->file('image')->move('busimage/', $request->file('image')->getClientOriginalName());
            $data->image = $request->file('image')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('databus')->with('success', 'Data bus successfully added');
    }

    public function tampilbus($id) {
        $data = Bus::find($id);
        //dd($data);

        return view('layout.bus.tampilbus', compact('data'));
    }

    public function updatebus(Request $request, $id) {
        $data = Bus::find($id);
        $data->update($request->all());
        if(session('halaman_url')) {
            return redirect(session('halaman_url'))->with('success', 'Data bus successfully updated');
        }
        
        if ($request->hasFile('image')) {
            $request->file('image')->move('busimage/', $request->file('image')->getClientOriginalName());
            $data->image = $request->file('image')->getClientOriginalName();
            $data->save();
        }

        return redirect()->route('databus')->with('success', 'Data bus successfully updated');
    }

    public function deletebus($id) {
        $data = Bus::find($id);
        $data->delete();

        return redirect()->route('databus')->with('success', 'Data bus successfully deleted');
    }
}
?>
