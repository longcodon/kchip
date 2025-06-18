{{-- filepath: c:\xampp\htdocs\kchip\resources\views\auth\login.blade.php --}}
@extends('layouts.guest')

@section('content')
<div class="login-wrapper">
    <div class="login-card">
        <div class="login-header">
            <i class="fas fa-user-circle"></i>
            <h2>Đăng nhập KChipShop</h2>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Nhập email của bạn">
                @error('email')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="password"><i class="fas fa-lock"></i> Mật khẩu</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Nhập mật khẩu">
                @error('password')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="options">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    Ghi nhớ đăng nhập
                </label>
                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        Quên mật khẩu?
                    </a>
                @endif
            </div>

            <button type="submit" class="login-submit">Đăng nhập</button>
        </form>
        <div class="login-footer">
            <span>Chưa có tài khoản?</span>
            <a href="{{ route('register') }}">Đăng ký ngay</a>
        </div>
    </div>
</div>
@endsection