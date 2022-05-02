<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function modalCreateVehicle()
    {
        return view('modal.createvehicle');
    }

    public function storeVehicle(Request $request)
    {
        Vehicle::create([
            'merk' => $request->merk,
            'fuel' => $request->fuel,
            'maintenance' => $request->maintenance,
            'history_used' => $request->history_used,
            'owner' => $request->owner,
        ]);
        return 'Success';
    }

    public function reloadVehicle()
    {
        $vehicles = Vehicle::get();
        return view('dashboard.partials.tablevehicle', compact('vehicles'));
    }

    public function modalEditVehicle($id)
    {
        $vehicle = Vehicle::findorfail($id);
        return view('modal.editvehicle', compact('vehicle'));
    }

    public function updateVehicle(Request $request, $id)
    {
        $vehicle = Vehicle::findorfail($id);
        $vehicle->update([
            'merk' => $request->merk,
            'fuel' => $request->fuel,
            'maintenance' => $request->maintenance,
            'history_used' => $request->history_used,
            'owner' => $request->owner,
        ]);
        return $vehicle;
    }
}
