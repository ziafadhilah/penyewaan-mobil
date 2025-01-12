<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Proses login
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Cek role setelah login
            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect()->route('cars.index'); // Redirect ke dashboard admin
            }

            if ($user->role == 'user') {
                return redirect()->route('cars.index'); // Redirect ke dashboard user
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
