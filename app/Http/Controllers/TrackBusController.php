<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TrackBusController extends Controller
{
    public function trackbus() {
        return view('layout.tracking-bus.trackbus');
    }

    public function trackrutebus(Request $request) {
        if ($request->has('search')) {
            $data = Rute::where('code_bus','LIKE','%' .$request->search.'%')->paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = Rute::paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        }

        return view('layout.tracking-bus.trackrutebus', compact('data'));
    }
}
