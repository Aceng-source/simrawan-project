<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('admin_id')) {
            return redirect()->route('dashboard');
        }

        return view('layouts.login');
    }

    public function login(Request $request)
    {
        $username = trim($request->input('username'));
        $password = $request->input('password');

        if (empty($username) || empty($password)) {
            return back()->with('error', 'Username dan password wajib diisi!')
                         ->withInput();
        }

        $admin = Admin::where('username', $username)
                      ->where('password', md5($password))
                      ->first();

        if (!$admin) {
            return back()->with('error', 'Username atau password salah!')
                         ->withInput();
        }

        session([
            'admin_id'   => $admin->id,
            'admin_nama' => $admin->nama,
            'admin_user' => $admin->username,
        ]);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('admin.login')
                         ->with('success', 'Berhasil logout.');
    }
}

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $customer = Customer::where('username', $request->username)
            ->where('password', md5($request->password))
            ->first();

        if ($customer) {

            session([
                'customer_id' => $customer->id,
                'customer_nama' => $customer->nama,
            ]);

            return redirect()->route('dashboard')
                ->with('login_success', 'Login Berhasil');
    }

    return back()->with('error', 'Username atau password salah');
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
