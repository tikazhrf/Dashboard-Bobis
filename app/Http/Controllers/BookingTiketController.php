<?php

namespace App\Http\Controllers;

use App\Models\BookingTiket;
use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingTiketController extends Controller
{
    public function bookingtiket() {

        $data = DB::table('buses')
        ->join('rutes', 'rutes.id', '=', 'buses.id')
        ->join('jadwals', 'jadwals.id', '=', 'buses.id')
        ->get();
        
        //dd($data);
        return view('layout.booking-tiket.bookingtiket')->with('data', $data);
    }

    public function tampilimage($id) {
        $data = Bus::find($id);
        //dd($data);

        return view('layout.booking-tiket.bookingtiket', compact('data'));
    }
}

