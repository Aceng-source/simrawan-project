@extends('layouts.app')

@section('title', 'Login Admin - SiMrawan')

@section('no-sidebar')
    {{-- Layout tanpa sidebar --}}
@endsection

@section('content')
<div class="login-page">

    {{-- Dekorasi --}}
    <div class="login-deco top-left">🐟</div>
    <div class="login-deco top-right">🐠</div>
    <div class="login-deco bot-left">🐡</div>
    <div class="login-deco bot-right">🐟</div>

    <div class="login-box">

        {{-- Brand --}}
        <div class="login-brand">
            <div class="logo">
                <span class="logo-si">Si</span>
                <span class="logo-m">M</span>
                <span class="logo-rawan">rawan</span>
            </div>
            <div class="sub">Mrawan Fish Farm</div>
        </div>

        <h2>LOGIN ADMIN</h2>
        <p class="sub">Masukkan username dan password admin</p>

        {{-- Alert Error --}}
        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        {{-- Alert Success --}}
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- Form Login Admin --}}
        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf

            {{-- Username --}}
            <div class="form-group">
                <label for="username">Username</label>

                <div class="input-icon">
                    <i class="fas fa-user"></i>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Masukkan username"
                        value="{{ old('username') }}"
                        required
                    >
                </div>
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password">Password</label>

                <div class="input-icon">
                    <i class="fas fa-lock"></i>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                    >
                </div>
            </div>

            {{-- Button --}}
            <button type="submit" class="login-btn">
                Login Admin &rarr;
            </button>
        </form>

        {{-- Back --}}
        <a href="{{ route('beranda') }}" class="login-back">
            &larr; Kembali ke beranda
        </a>

    </div>
</div>
@endsection
