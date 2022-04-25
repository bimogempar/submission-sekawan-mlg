<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        if (auth()->check()) {
            return redirect()->route('indexAdmin');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->withInput();
        }

        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], request()->has('remember'));

        if (auth()->user()->role == 2) {
            return redirect()->route('indexAdmin');
        } elseif (auth()->user()->role == 3) {
            return redirect()->route('indexApproval');
        } else {
            return redirect()->route('indexUser');
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('loginPage');
    }
}
