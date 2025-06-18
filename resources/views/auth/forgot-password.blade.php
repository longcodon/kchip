{{-- filepath: c:\xampp\htdocs\kchip\resources\views\auth\forgot-password.blade.php --}}
@extends('layouts.guest')

@section('content')
<div class="login-wrapper">
    <div class="login-card">
        <div class="login-header">
            <i class="fas fa-envelope"></i>
            <h2>Quên mật khẩu</h2>
        </div>
        <div class="mb-4 text-sm text-gray-600" style="text-align:center;">
            {{ __('Quên mật khẩu? Nhập email của bạn và chúng tôi sẽ gửi liên kết đặt lại mật khẩu.') }}
        </div>
        <!-- Session Status -->
        @if (session('status'))
            <div class="input-error" style="color: #00b8d9; text-align:center;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="input-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Nhập email của bạn">
                @error('email')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="login-submit">Gửi liên kết đặt lại mật khẩu</button>
        </form>
        <div class="login-footer">
            <a href="{{ route('login') }}">&#8592; Quay lại đăng nhập</a>
        </div>
    </div>
</div>
@endsection