<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('no_induk', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role_id == 2) {
                return redirect('Sdashboard');
            } elseif ($user->role_id == 1) {
                return redirect('Gdashboard');
            }
        }

        return back()->withErrors([
            'pesan' => 'No induk atau password tidak terdaftar',
        ]);
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
