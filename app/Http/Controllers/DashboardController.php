<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            return view('dashboard.admin');
        } else {
            return view('dashboard.nasabah');
        }
    }
}
