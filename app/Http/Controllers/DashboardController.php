<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexAdmin()
    {
        $data = 'Dashboard Admin';
        return view('dashboard.index', compact('data'));
    }

    public function indexApproval()
    {
        $data = 'Dashboard Penyetuju';
        return view('dashboard.index', compact('data'));
    }
}
