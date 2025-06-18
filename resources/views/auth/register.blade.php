{{-- filepath: c:\xampp\htdocs\kchip\resources\views\auth\register.blade.php --}}
@extends('layouts.guest')

@section('content')
<div class="login-wrapper">
    <div class="login-card">
        <div class="login-header">
            <i class="fas fa-user-plus"></i>
            <h2>Đăng ký tài khoản <br> KChipShop</h2>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group">
                <label for="name"><i class="fas fa-user"></i> Họ và tên</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Nhập họ và tên">
                @error('name')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Nhập email">
                @error('email')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="password"><i class="fas fa-lock"></i> Mật khẩu</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Nhập mật khẩu">
                @error('password')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="password_confirmation"><i class="fas fa-lock"></i> Xác nhận mật khẩu</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Nhập lại mật khẩu">
                @error('password_confirmation')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="login-submit" style="margin-top: 10px;">Đăng ký</button>
        </form>
        <div class="login-footer">
            <span>Đã có tài khoản?</span>
            <a href="{{ route('login') }}">Đăng nhập</a>
        </div>
    </div>
</div>
@endsection