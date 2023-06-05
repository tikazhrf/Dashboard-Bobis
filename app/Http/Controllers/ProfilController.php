<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function profile() {

        // $data = JenisTiket::all();
        // //dd($data);
        return view('partials.profil.profile');
    }

    public function editprofile(){
        return view('partials.profil.editprofile');
    }

}
