<?php

namespace App\Http\Controllers;

use App\Models\Rent;
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

        return redirect()->route('indexAdmin');
    }
}
