<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $userExists = User::where('username', $request->username)->exists();

        if (!$userExists) {
            return redirect()->route('login')
                ->with('error', 'Akun Belum Terdaftar')
                ->withInput();
        }

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect()->route('login')
            ->with('login_success', 'Login Berhasil');
}

        return redirect()->route('login')
            ->with('error', 'Username atau password salah.')
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // Redirect ke login, bawa flash 'logout_success'
        return redirect()->route('login')
            ->with('logout_success', 'Berhasil Logout');
    }
}
