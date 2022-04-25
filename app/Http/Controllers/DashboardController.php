<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexAdmin()
    {
        $admin = 'Dashboard Admin';
        return view('dashboard.index', compact('admin'));
    }
}
