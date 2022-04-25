<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\User;
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
        $approvals = User::where('role', 3)->get();
        $drivers = User::where('role', 1)->get();
        $vehicles = Vehicle::get();
        $rents = Rent::with('vehicle', 'driver', 'approval')->get();
        $data = 'Dashboard Admin';
        return view('dashboard.index', compact('data', 'vehicles', 'rents', 'approvals', 'drivers'));
    }

    public function indexApproval()
    {
        $vehicles = Vehicle::get();
        $rents = Rent::with('vehicle', 'driver', 'approval')->get();

        $data = 'Dashboard Penyetuju';
        return view('dashboard.index', compact('data', 'vehicles', 'rents'));
    }
}
