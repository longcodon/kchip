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
        <a href="#"class="coming-soon">Dịch Vụ</a>
        <a href="#"class="coming-soon">Diễn Đàn</a>
    </nav>
    <div class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
    </div>
    <div class="user-icons">
        <i class="fas fa-search coming-soon"></i>
        <i class="fas fa-user coming-soon"></i>
        <i class="fas fa-heart coming-soon"></i>
        <i class="fas fa-shopping-cart " id="cart-icon"></i>
    </div>      
  </header>
  <section class="notice-banner">
    <div class="notice-header" id="noticeToggle">
      <strong>Ưu đãi giảm giá</strong>
      <i class="fas fa-chevron-down toggle-icon"></i>
    </div>
    <div class="notice-content" id="noticeContent">
      <p>
        giảm giá 10% cho tất cả các sản phẩm Mã: KCHIP10 thử đi rồi biết 
        <strong>bắt đầu từ: 20/20/20202020</strong>
      </p>
      <p>
        giảm giá 10% cho tất cả các sản phẩm 
      </p>
      <p>Thank you for your understanding and continued support!<br>— The thatskyshop Team</p>
      <a href="#" class="learn-more">Learn more</a>
    </div>
  </section>

  <main class="all-products">
    <h2 class="section-title">Tất Cả Sản Phẩm</h2>
   <div class="product-filters">
  <div class="filters">
    <label for="filter-author">Người Soạn:</label>
    <select id="filter-author">
      <option value="">Tất cả</option>
      <option value="kchip">KChip</option>
      <option value="kteam">KTeam</option>
    </select>

    <label for="filter-type">Thể loại:</label>
    <select id="filter-type">
      <option value="">Tất cả</option>
      <option value="vietnam">Việt Nam</option>
      <option value="khac">Khác</option>
    </select>
  </div>

  <div class="sort">
    <label for="sort-price">Sắp xếp:</label>
    <select id="sort-price">
      <option value="">--</option>
      <option value="asc">Giá thấp - cao</option>
      <option value="desc">Giá cao - thấp</option>
    </select>
  </div>
</div>



<div class="product-gallery">
      <!-- SẢN PHẨM MẪU (có thể lặp để thêm) -->
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
        <div class="discount-code">
            <input type="text" placeholder="Nhập mã giảm giá" />
            <button class="apply-coupon-btn " onclick="applyCoupon()" >Áp dụng</button>
        </div>
        <div class="cart-total">
          <span>Tổng cộng:</span>
          <strong id="cartTotal">0 ₫</strong>
        </div>
        <button class="checkout-btn" >Thanh toán</button>
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
