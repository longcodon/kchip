
<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('frontend/css/register.css') }}">
    <div class="register-bg">
        <div class="register-card">
            <div class="register-header">
                <span class="kchipshop-logo">
                    <span style="color:#16a2dc;font-weight:700;">KChip</span><span style="color:#333;font-weight:700;">Shop</span>
                </span>
                <h2>Đăng ký tài khoản</h2>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Họ tên</label>
                    <x-text-input id="name" class="form-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="input-error" />
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="input-error" />
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <x-text-input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="input-error" />
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Nhập lại mật khẩu</label>
                    <x-text-input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="input-error" />
                </div>

                <button type="submit" class="register-btn">Đăng ký</button>

                <div class="register-footer">
                    Đã có tài khoản?
                    <a href="{{ route('login') }}">Đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>