
<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('frontend/css/login.css') }}">
    <div class="login-bg">
        <div class="login-card">
            <div class="login-header">
                <span class="kchipshop-logo">
                    <span style="color:#16a2dc;font-weight:700;">KChip</span><span style="color:#333;font-weight:700;">Shop</span>
                </span>
                <h2>Đăng nhập</h2>
            </div>
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="input-error" />
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <x-text-input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="input-error" />
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span>Ghi nhớ đăng nhập</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            Quên mật khẩu?
                        </a>
                    @endif
                </div>

                <button type="submit" class="login-btn">Đăng nhập</button>
            </form>
            <div class="login-footer">
                Chưa có tài khoản?
                <a href="{{ route('register') }}">Đăng ký</a>
            </div>
        </div>
    </div>
</x-guest-layout>