<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>That Sky Shop Clone</title>
  <link rel="stylesheet" href="{{asset('frontend/css/index.css')}}" />
  <link rel="stylesheet" href="{{asset('frontend/css/product2.css')}}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
{{--  
         <i class="fas fa-search coming-soon"></i>

        <i class="fas fa-user coming-soon"></i>
        <i class="fas fa-heart coming-soon"></i>
        <i class="fas fa-shopping-cart " id="cart-icon"></i> --}}
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
  <section class="notice-banner">
    <div class="notice-header" id="noticeToggle">
      <strong>Ưu đãi giảm giá</strong>
      <i class="fas fa-chevron-down toggle-icon"></i>
    </div>
    <div class="notice-content" id="noticeContent">
 <p>{{ $thongbao->uudai ?? 'Chưa có nội dung' }}</p>
    </div>
  </section>

  <main class="all-products">
    <h2 class="section-title">Tất Cả Sản Phẩm</h2>
   <div class="product-filters">
<form method="GET" id="filter-form" class="filters" style="display: flex; gap: 2rem; flex-wrap: wrap;">
  <div>
    <label for="filter-author">Người Soạn:</label>
    <select id="filter-author" name="transcribed" onchange="this.form.submit()">
      <option value="">Tất cả</option>
      <option value="kchip" {{ request('transcribed') == 'kchip' ? 'selected' : '' }}>KChip</option>
      <option value="kteam" {{ request('transcribed') == 'kteam' ? 'selected' : '' }}>KTeam</option>
    </select>
  </div>

  <div>
    <label for="filter-type">Thể loại:</label>
    <select id="filter-type" name="country" onchange="this.form.submit()">
      <option value="">Tất cả</option>
      <option value="VN" {{ request('country') == 'VN' ? 'selected' : '' }}>Việt Nam</option>
      <option value="khac" {{ request('country') == 'khac' ? 'selected' : '' }}>Khác</option>
    </select>
  </div>

  <div class="sort">
    <label for="sort-price">Sắp xếp:</label>
    <select id="sort-price" name="sort" onchange="this.form.submit()">
      <option value="">--</option>
      <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Giá thấp - cao</option>
      <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Giá cao - thấp</option>
    </select>
  </div>
</form>



  
</div>



<div class="product-gallery">
      <!-- SẢN PHẨM MẪU (có thể lặp để thêm) -->
@foreach($danhmuc as $key => $item)
    @php
        $videoId = \Illuminate\Support\Str::after($item->link, 'v=');
    @endphp

    <div class="product-card" onclick="openModal(
        '{{ $item->title ?? 'Không có tên' }}',
        '{{ $item->image ? asset('uploads/danhmuc/'.$item->image) : asset('/images/default.png') }}',
        '{{ $item->description ?? 'Đang cập nhật mô tả' }}',
        '{{ isset($item->price) ? number_format($item->price, 0, ',', '.').' ₫' : 'Liên hệ' }}',
        '{{ $item->author ?? 'Chưa rõ' }}',
        '{{ $item->transcribed ?? 'KChipShop' }}',
        'https://www.youtube.com/embed/{{ $videoId }}'
    )">
    <span class="author-chip-corner">
        <i class="fas fa-user-pen"></i>
        {{ $item->transcribed ?? 'KChipShop' }}
    </span>
        <div class="product-image">
            <img src="{{ $item->image ? asset('uploads/danhmuc/'.$item->image) : asset('/images/default.png') }}"
                 alt="{{ $item->title ?? '' }}" />
        </div>
        <h4>{{ $item->title ?? 'Sản phẩm mới' }}</h4>
<span class="author-chip-modern">
    <i class="fas fa-user-pen"></i>
    {{ $item->transcribed ?? 'KChipShop' }}
</span>
        {{-- <div class="product-price" style="font-weight:600; color:#009dde; margin-bottom:10px;">
            {{ isset($item->price) ? number_format($item->price, 0, ',', '.') . ' ₫' : 'Liên hệ' }}
        </div> --}}
        <button class="price-btn" style="font-weight:600; font-size:18px;">
            {{ isset($item->price) ? number_format($item->price, 0, ',', '.') . ' ₫' : 'Liên hệ' }}
        </button>
    </div>
@endforeach

      <!-- THÊM NHIỀU DIV .product-card NẾU CẦN -->
</div>

    <div class="pagination" id="pagination"></div>
  </main>


  <footer class="main-footer">
    <div class="footer-container">
      <div class="footer-column">
        <h4>RESOURCES</h4>
        <a href="#">Shipping Policy</a>
        <a href="#">Pre-Order Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Privacy Policy</a>
      </div>
      <div class="footer-column">
        <h4>ABOUT</h4>
        <a href="#">Our Mission</a>
        <a href="#">FAQs</a>
        <a href="#">Contact Us</a>
        <a href="#">Careers</a>
      </div>
      <div class="footer-column">
        <h4>JOIN OUR MAILING LIST</h4>
        <p>Never miss a moment of magic from us!</p>
        <form>
          <input type="email" placeholder="Email" />
          <button type="submit">→</button>
        </form>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2025 ThatMemory LLC — All Rights Reserved</p>
      <div class="social-icons">
        <span>📘</span>
        <span>📷</span>
        <span>🐦</span>
      </div>
    </div>
  </footer>






  <div class="modal" id="product-modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <div class="modal-body">

        <!-- Ảnh sản phẩm -->
        <img id="modal-image" alt="Ảnh sản phẩm" class="modal-image" />
   
       <!-- Thông tin sản phẩm -->
        <div class="modal-info">
          <h2 id="modal-title" name='title'>Tên sản phẩm</h2>
          <p id="modal-description" name='description'>Mô tả sản phẩm chi tiết.</p>
          <p><strong>Tác giả:</strong> <span id="modal-author" name='author'></span></p>
          <p><strong>Người soạn:</strong> <span id="modal-transcriber" name='transcribed'></span></p>
          <p><strong>Giá:</strong> <span id="modal-price" name='price'></span></p>
          <button class="add-cart-btn" >Thêm vào giỏ hàng</button>
        </div>


        
        <!-- Video nhúng -->
        <div class="video-container">
          <iframe id="modal-video" src="" frameborder="0" allowfullscreen></iframe>
        </div>
  
      </div>
    </div>
  </div>
  
  <!-- Giỏ hàng popup -->

  <div class="cart-overlay" id="cartOverlay">
    <div class="cart-panel">
      <div class="cart-header">
        <h3>Giỏ hàng</h3>
        <span class="close-cart" onclick="toggleCart()">&times;</span>
      </div>
      <div class="cart-items" id="cartItems"></div>
      <div class="cart-footer">
        {{-- <div class="discount-code">
            <input type="text" placeholder="Nhập mã giảm giá" />
            <button class="apply-coupon-btn " onclick="applyCoupon()" >Áp dụng</button>
        </div> --}}
        <div class="cart-total">
          <span>Tổng cộng:</span>
          <strong id="cartTotal">0 ₫</strong>
        </div>
        <button class="checkout-btn" onclick="window.location.href='{{ route('pay') }}'" >Thanh toán</button>
      </div>
    </div>
  </div>

  
   
  <script src="{{asset('frontend/js/index.js')}}"></script>
  <script src="{{asset('frontend/js/product2.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
  const SAVE_CART_URL = "{{ url('/save-cart') }}";
</script>

<script>
    const PAY_URL = "{{ route('pay') }}";
</script>

</body>
</html>
