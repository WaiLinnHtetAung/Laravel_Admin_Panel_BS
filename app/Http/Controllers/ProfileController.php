<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProfileController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

}
