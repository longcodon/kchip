<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>That Sky Shop Clone</title>
  <link rel="stylesheet" href="{{ asset('frontend/css/index.css') }}" />
  @if (Request::routeIs('dichvu'))
    <link rel="stylesheet" href="{{ asset('frontend/css/dichvu.css') }}">
@endif

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
@if (Request::routeIs('dichvu'))
    <script src="{{ asset('frontend/js/dichvu.js') }}"></script>
@endif

<body>
  <header>
    <div class="logo"><span>KChip</span>Shop</div>
    <nav id="main-nav">
        <a href="{{ route('index') }}">Trang Chủ</a>
        <a href="{{ route('full',['tat-ca-san']) }}">Sản Phẩm</a>
        <a href="{{ route('dichvu') }}">Dịch Vụ</a>
        
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
 <div class="user-icons">
    @auth
        <div class="user-dropdown">
            <button class="user-btn">
                <i class="fas fa-user-circle"></i>
                {{ Auth::user()->name }}
            </button>
            <div class="dropdown-content">
                <a href="{{ route('profile.edit') }}">Hồ sơ</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-link">Đăng xuất</button>
                </form>
            </div>
        </div>
    @else
        <a href="{{ route('login') }}" class="login-btn">Đăng nhập</a>
    @endauth
</div>
</div>
    </div>      
  </header>



<section class="custom-sheet-section">
    <div class="sheet-container">
        <h2 class="sheet-title">ĐẶT SHEET THEO YÊU CẦU</h2>
        <p class="sheet-intro">
            Được nhiều sự quan tâm tới những sheet nhạc KChip, mình xin phép mở lại nhận đặt sheet theo yêu cầu. Do thời gian học khá nhiều nên mình không thể nhận thêm những sheet nhạc thường, ở đây có 2 lựa chọn cho những sheet đặc biệt:
        </p>
        <ul class="sheet-list">
            <li><strong>Private sheet (80-120k):</strong>
                <ul>
                    <li>Sheet không được công khai các nốt nhạc nếu được mình đăng lên mạng xã hội ⇒ người khác không thể sao chép.</li>
                    <li>Giá sheet private khi bán lại sẽ nhỏ hơn khi đặt (40-60k). Khi một sheet private được bán, người đặt sheet ban đầu sẽ nhận được thêm 1 lần chọn sheet thường (free) bất kỳ hoặc giảm 30k khi mua sheet private cỡ sản (tối đa 2 lượt cho 1 sheet).</li>
                </ul>
            </li>
            <li><strong>Sheet độc quyền (160-250k):</strong>
                <ul>
                    <li>Toàn quyền sử dụng sheet nhạc, không công khai tên bài cũng như nội dung sheet.</li>
                </ul>
            </li>
            <li><em>❗Mặc định:</em> Tặng một sheet thường bất kỳ khi đặt sheet đối với bất cứ hình thức đặt sheet nào.</li>
        </ul>
        <p class="sheet-note">
            <em>* Mức giá được quy định một phần theo độ dài và mức độ hoàn thiện do mình đánh giá. Một số bài không phù hợp với đàn trong game hoặc mình không đủ khả năng thực hiện sẽ không được nhận để đảm bảo chất lượng sheet nhạc.</em>
        </p>
        <p class="sheet-contact">
            📩 Liên hệ Fanpage: <a href="#">link</a>
        </p>
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

   
  <script src="{{ asset('frontend/js/index.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  const SAVE_CART_URL = "{{ url('/save-cart') }}";
</script>


  
</body>

</html>
