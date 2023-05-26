<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function usermanagement() {
        return view('layout.user-management.usermanagement');
    }
}
