<!DOCTYPE html>
<html lang="vi">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Đơn hàng | KChip Shop</title>
  <link rel="stylesheet" href="{{ asset('frontend/css/index.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
    }

    .custom-sheet-section {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      background-color: #f9f9f9;
      padding: 40px 20px;
    }

    .sheet-container {
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      max-width: 800px;
      width: 100%;
    }

    .sheet-title {
      text-align: center;
      font-size: 26px;
      margin-bottom: 20px;
    }

    .sheet-intro {
      margin-bottom: 30px;
      border-bottom: 1px solid #ddd;
      padding-bottom: 20px;
    }

    .sheet-intro p {
      margin: 6px 0;
    }

    .alert {
      margin-top: 15px;
      padding: 12px;
      border-radius: 6px;
      font-weight: bold;
    }

    .alert-success {
      background-color: #d4edda;
      color: #155724;
    }

    .alert-warning {
      background-color: #fff3cd;
      color: #856404;
    }

    .alert-info {
      background-color: #cce5ff;
      color: #004085;
    }

    footer.main-footer {
      background-color: #f5f5f5;
      padding: 20px 0;
      text-align: center;
    }
  </style>
</head>

<body>
  <header>
    <div class="logo"><span>KChip</span>Shop</div>
    <nav id="main-nav">
        <a href="{{ route('index') }}">Trang Chủ</a>
        <a href="{{ route('full',['tat-ca-san']) }}">Sản Phẩm</a>
        <a href="{{ route('dichvu') }}">Dịch Vụ</a>
        <a href="{{ route('donhang') }}">Đơn hàng</a>
    </nav>
    <div class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
    </div>
    <div class="user-icons">
        <div class="auth-buttons">
            @auth
              <div class="user-menu">
                  <div class="user-avatar">
                      <i class="fas fa-user"></i>
                  </div>
                  <span class="user-name">{{ Auth::user()->name }}</span>
                  <i class="fas fa-chevron-down user-caret"></i>
                  <div class="dropdown-content">
                      <a href="{{ route('profile.edit') }}">Hồ sơ</a>
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <button type="submit" class="logout-link">Đăng xuất</button>
                      </form>
                  </div>
              </div>
            @else
                <div class="button-container">
                  <a href="{{ route('login') }}" class="menu-btn login-menu">
                  <i class="fas fa-sign-in-alt"></i>
                    Đăng nhập
                  </a>
              <a href="{{ route('register') }}" class="menu-btn register-menu">
                  <i class="fas fa-user-plus"></i>
                  Đăng ký
              </a>
          </div>
            @endauth
        </div>
    </div>      
  </header>

  <!-- ✅ Nội dung chính -->
  <section class="custom-sheet-section">
    <div class="sheet-container">
      <h2 class="sheet-title">TẤT CẢ ĐƠN HÀNG</h2>

      @if($donhang->count())
        @foreach($donhang as $item)
          <div class="sheet-intro">
            <p><strong>👤 Họ tên:</strong> {{ $item->name }}</p>
            <p><strong>📧 Email:</strong> {{ $item->email }}</p>
            <p><strong>📦 Sản phẩm:</strong> {{ $item->title}}</p>
            @if($item->fb)
              <p><strong>🔗 Facebook:</strong> <a href="{{ $item->fb }}" target="_blank">{{ $item->fb }}</a></p>
             @endif
            @if($item->note)
              <p><strong>📝 Ghi chú:</strong> {{ $item->note }}</p>
            @endif
            <p><strong>✅ Phương thức thanh toán:</strong> <span style="color: blue;">{{ $item->trangthai ?? 'Chưa xử lý' }}</span></p>

            @if($item->trangthai == 'đã xác nhận')
              <div class="alert alert-success">✅ Đơn hàng đã được xác nhận, khách yêu chờ nhé!</div>
            @elseif($item->trangthai == 'đã gửi hàng')
              <div class="alert alert-warning">🚚 Đơn hàng đã đến tay, check mail thui nào!</div>
            @else
              <div class="alert alert-info">ℹ️ Trạng thái đơn hàng: 
                
                @if($item->trangthai=='thucod') 
                  chờ xác nhận 
                @else 
                đã xác nhận
                @endif
              
              </div>
            @endif
           
          </div>
        @endforeach
      @else
        <p>Không tìm thấy đơn hàng nào.</p>
      @endif

      <p class="sheet-contact" style="margin-top: 25px;">
        📩 Liên hệ Fanpage: <a href="https://www.facebook.com/profile.php?id=100083202309058">link</a>
      </p>
    </div>
  </section>

  <!-- ✅ Footer luôn ở dưới -->
  <footer class="main-footer">
    <div>
      <p>&copy; 2025 KChip Shop — All Rights Reserved</p>
    </div>
  </footer>

  <script src="{{ asset('frontend/js/index.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
