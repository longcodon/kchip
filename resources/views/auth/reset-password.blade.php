{{-- filepath: c:\xampp\htdocs\kchip\resources\views\auth\reset-password.blade.php --}}
@extends('layouts.guest')

@section('content')
<div class="login-wrapper">
    <div class="login-card">
        <div class="login-header">
            <i class="fas fa-key"></i>
            <h2>Đặt lại mật khẩu</h2>
        </div>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
        @method('PUT')  
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $email ?? request('email')) }}" required autofocus>
                @error('email')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="password"><i class="fas fa-lock"></i> Mật khẩu mới</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Nhập mật khẩu mới">
                @error('password')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="password_confirmation"><i class="fas fa-lock"></i> Xác nhận mật khẩu</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Nhập lại mật khẩu mới">
                @error('password_confirmation')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="login-submit" style="margin-top: 10px;">Đặt lại mật khẩu</button>
        </form>
        <div class="login-footer">
            <a href="{{ route('login') }}">&#8592; Quay lại đăng nhập</a>
        </div>
    </div>
</div>
@endsection