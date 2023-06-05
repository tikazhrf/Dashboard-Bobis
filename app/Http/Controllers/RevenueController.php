<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function revenue() {

        // $data = JenisTiket::all();
        // //dd($data);
        return view('layout.finance.revenue');
    }
}
