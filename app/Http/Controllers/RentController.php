<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function storeRent(Request $request)
    {
        // return $request->all();
        Rent::create([
            'fuel' => $request->fuel,
            'vehicle_id' => $request->vehicle_id,
            'driver' => $request->driver,
            'approval' => $request->driver,
            'rent_date' => $request->rent_date,
        ]);

        return response('Success', 200);
    }

    public function modalCreateRent()
    {
        $approvals = User::where('role', 3)->get();
        $drivers = User::where('role', 1)->get();
        $vehicles = Vehicle::get();
        return view('modal.reqrentvehicle', compact('approvals', 'drivers', 'vehicles'));
    }

    public function reloadRent()
    {
        $approval = User::where('role', 3)->get();
        $driver = User::where('role', 1)->get();
        $rents = Rent::with('vehicle', 'driver', 'approval')->get();
        return view('dashboard.partials.tablerent', compact('rents'));
    }
}
