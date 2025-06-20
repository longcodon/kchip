<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>That Sky Shop Clone</title>
  <link rel="stylesheet" href="{{ asset('frontend/css/index.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <header>
    <div class="logo"><span>KChip</span>Shop</div>
    <nav id="main-nav">
        <a href="{{ route('welcome') }}">Trang Chủ</a>
        <a href="{{ route('full',['tat-ca-san']) }}">Sản Phẩm</a>
        <a href="{{ route('dichvu') }}">Dịch Vụ</a>
        <a href="#" onclick="checkLogin(event)">Đơn hàng</a>




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
    </div>
  </header>

  <section class="banner-slider">
    <div class="slider">
      <div class="slide active">
        <img src="frontend/images/bn2.png" alt="Banner 1">
        <div class="slide-content">
          <h2>Khám phá KChipShop</h2>
          <p>Nơi kết nối đam mê và trải nghiệm âm nhạc đỉnh cao </p>
        </div>
      </div>
      <div class="slide">
        <img src="frontend/images/bn3.png" alt="Banner 2">
        <div class="slide-content">
          <h2>Bàn Phím Điện Tử EASYPLAY1s</h2>
          <p>được thiết kế dựa trên các phím đàn trong Sky</p>
          <a href="https://www.kickstarter.com/projects/summertones/easyplay-1s-pocket-sized-passion-easy-play-inspiration" class="btn">Mua Ngay</a>
        </div>
      </div>
    </div>
    <div class="slider-dots">
      <span class="dot active" onclick="currentSlide(0)"></span>
      <span class="dot" onclick="currentSlide(1)"></span>
    </div>
  </section>

  <section class="notice-banner">
    <div class="notice-header" id="noticeToggle">
      <strong>Thông báo</strong>
      <i class="fas fa-chevron-down toggle-icon"></i>
    </div>
    <div class="notice-content" id="noticeContent">
     <p>{{ $thongbao->trangchu ?? 'Chưa có nội dung' }}</p>
    </div>
  </section>

  

  <section class="featured-section">
    <h2>Video Nổi Bật</h2>
    <div class="featured-videos">
      <div class="video-wrapper">
        <iframe src="https://www.youtube.com/embed/AZZVxLj80Rk?si=fjoVVnxC751GQY12"
            frameborder="0"
            allow="autoplay; encrypted-media"
            allowfullscreen
            class="minimal-youtube">
        </iframe>
        <p class="video-title">[Sky Music] Phép Màu (OST Đàn Cá GỖ)</p>
      </div>
      <div class="video-wrapper">
        <iframe src="https://www.youtube.com/embed/WTH0Tctf600?si=_RMCe3TqaCWJ23sQ"
            frameborder="0"
            allow="autoplay; encrypted-media"
            allowfullscreen
            class="minimal-youtube">
        </iframe>
        <p class="video-title">[Sky Sheet-Free] Đừng Làm Trái Tim Anh Đau</p>
      </div>
      <div class="video-wrapper">
        <iframe src="https://www.youtube-nocookie.com/embed/mkA2XJmNTO8?controls=1&modestbranding=1&rel=0&disablekb=1&fs=0"
            frameborder="0"
            allow="autoplay; encrypted-media"
            allowfullscreen
            class="minimal-youtube">
        </iframe>
        <p class="video-title">[Sky Sheet-Free] カナタハルカ / Kanata Haruka</p>
      </div>
    </div>
  </section>

  <section class="product-gallery-section">
    <h2 class="section-title">Sản Phẩm</h2>
    <div class="product-gallery">
    @foreach($danhmuc as $key => $item)
    @php
        $videoId = \Illuminate\Support\Str::after($item->link, 'v=');
      //   print($videoId); 
      // print($item->link);
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
        <div class="product-image">
            <img src="{{ $item->image ? asset('uploads/danhmuc/'.$item->image) : asset('/images/default.png') }}"
                 alt="{{ $item->title ?? '' }}" />
        </div>
        <h4>{{ $item->title ?? 'Sản phẩm mới' }}</h4>
        <button class="price-btn">Xem sản phẩm</button>
    </div>
@endforeach
    </div>


    <div class="see-more-wrapper">
      <button onclick="window.location.href='{{ route('full') }}'" class="see-more-btn coming-soon"> Tất Cả</button>
    </div>
  </section>

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
          <h2 id="modal-title">Tên sản phẩm</h2>
          <p id="modal-description">Mô tả sản phẩm chi tiết.</p>
          <p><strong>Tác giả:</strong> <span id="modal-author"></span></p>
          <p><strong>Người soạn:</strong> <span id="modal-transcriber"></span></p>
          <p><strong>Giá:</strong> <span id="modal-price"></span></p>
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
        <div class="discount-code">
            <input type="text" placeholder="Nhập mã giảm giá" />
            <button class="apply-coupon-btn " onclick="applyCoupon()" >Áp dụng</button>
        </div>
        <div class="cart-total">
          <span>Tổng cộng:</span>
          <strong id="cartTotal">0 ₫</strong>
        </div>
        <button class="checkout-btn">Thanh toán</button>
      </div>
    </div>
  </div>
  
  
   
  <script src="{{ asset('frontend/js/index.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  



  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function checkLogin(event) {
        event.preventDefault();
        @auth
            // Nếu đã đăng nhập thì chuyển trang
            window.location.href = "{{ route('donhang') }}";
        @else
            // Nếu chưa đăng nhập thì hiện toast và chuyển sau 2s
            Swal.fire({
                icon: 'warning',
                title: 'Bạn cần đăng nhập để xem đơn hàng!',
                showConfirmButton: false,
                timer: 1500,
                toast: true,
                position: 'top-end',
                timerProgressBar: true,
                didClose: () => {
                    window.location.href = "{{ route('login') }}";
                }
            });
        @endauth
    }
</script>

</body>
</html>