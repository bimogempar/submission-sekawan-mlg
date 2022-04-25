<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexUser()
    {
        $vehicles = Vehicle::get();

        $data = 'Dashboard User';
        return view('dashboard.index', compact('data', 'vehicles'));
    }

    public function indexAdmin()
    {
        $vehicles = Vehicle::get();

        $rents = Rent::with('vehicle', 'driver', 'approval')->get();

        $data = 'Dashboard Admin';
        return view('dashboard.index', compact('data', 'vehicles', 'rents'));
    }

    public function indexApproval()
    {
        $vehicles = Vehicle::get();

        $data = 'Dashboard Penyetuju';
        return view('dashboard.index', compact('data', 'vehicles'));
    }
}
