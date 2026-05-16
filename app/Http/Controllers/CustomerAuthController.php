<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerAuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('customer_id')) {
            return redirect()->route('beranda');
        }

        return view('layouts.login');
    }

    public function login(Request $request)
    {
        $email = trim($request->email);
        $password = $request->password;

        if (empty($email) || empty($password)) {
            return back()->with('error', 'Email dan password wajib diisi!')
                         ->withInput();
        }

        $customer = Customer::where('email', $email)
            ->where('password', md5($password))
            ->first();

        if (!$customer) {
            return back()->with('error', 'Email atau password salah!')
                         ->withInput();
        }

        session([
            'customer_id'   => $customer->id,
            'customer_nama' => $customer->nama,
        ]);

        return redirect()->route('beranda')
                         ->with('success', 'Login berhasil!');
    }

    public function logout()
    {
        session()->forget([
            'customer_id',
            'customer_nama'
        ]);

        return redirect()->route('login')
                         ->with('success', 'Berhasil logout!');
    }
}
