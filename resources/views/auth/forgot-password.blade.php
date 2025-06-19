
<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('frontend/css/forgot.css') }}">
    <div class="forgot-bg">
        <div class="forgot-card">
            <div class="forgot-header">
                <span class="kchipshop-logo">
                    <span style="color:#16a2dc;font-weight:700;">KChip</span><span style="color:#333;font-weight:700;">Shop</span>
                </span>
                <h2>Quên mật khẩu</h2>
                <p class="forgot-desc">Nhập email để nhận liên kết đặt lại mật khẩu.</p>
            </div>
            @if (session('status'))
                <div class="forgot-success">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="input-error" />
                </div>

                <button type="submit" class="forgot-btn">Gửi liên kết</button>

                <div class="forgot-footer">
                    <a href="{{ route('login') }}">Quay lại đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>