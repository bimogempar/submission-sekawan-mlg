<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

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
        $success = auth()->attempt([
            'email' => request('email'),
            'password' => request('password')
        ], request()->has('remember'));

        if ($success) {
            return redirect()->to(RouteServiceProvider::HOME);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
