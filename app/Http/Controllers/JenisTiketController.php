<?php

namespace App\Http\Controllers;

use App\Models\JenisTiket;
use Illuminate\Http\Request;

class JenisTiketController extends Controller
{
    public function kategoritiket() {

        $data = JenisTiket::all();
        //dd($data);
        return view('layout.kategori-tiket.kategoritiket', compact('data'));
    }

    public function tambahtiket() {
        return view('layout.kategori-tiket.tambahtiket');
    }

    public function inserttiket(Request $request) {
        //dd($request->all());
        JenisTiket::create($request->all());

        return redirect()->route('kategoritiket')->with('success', 'Ticket Category successfully added');
    }

    public function tampiltiket($id) {

        $data = JenisTiket::find($id);
        //dd($data);

        return view('layout.kategori-tiket.tampiltiket', compact('data'));
    }

    public function updatetiket(Request $request, $id) {
        $data = JenisTiket::find($id);
        $data->update($request->all());

        return redirect()->route('kategoritiket')->with('success', 'Ticket Category successfully updated');
    }

    public function deletetiket(Request $request, $id) {

        $data = JenisTiket::find($id);
        $data->delete($request->all());

        return redirect()->route('kategoritiket')->with('success', 'Ticket Category successfully deleted');
    }
}
