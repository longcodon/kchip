
<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('frontend/css/reset.css') }}">
    <div class="reset-bg">
        <div class="reset-card">
            <div class="reset-header">
                <span class="kchipshop-logo">
                    <span style="color:#16a2dc;font-weight:700;">KChip</span><span style="color:#333;font-weight:700;">Shop</span>
                </span>
                <h2>Đặt lại mật khẩu</h2>
                <p class="reset-desc">Nhập email và mật khẩu mới của bạn.</p>
            </div>
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="form-group">
                    <label for="email">Email</label>
                    <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="input-error" />
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu mới</label>
                    <x-text-input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="input-error" />
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Nhập lại mật khẩu</label>
                    <x-text-input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="input-error" />
                </div>

                <button type="submit" class="reset-btn">Đặt lại mật khẩu</button>

                <div class="reset-footer">
                    <a href="{{ route('login') }}">Quay lại đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>