<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sự kiện Mùa Hè Rực Rỡ | KChipSkyShop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/event.css') }}">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-top">
                <div class="logo">
                    <a href="index.html">KChipSkyShop</a>
                </div>
                <div class="search-box">
                    <input type="text" placeholder="Tìm kiếm sản phẩm...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="header-icons">
                    <a href="#"><i class="fas fa-user"></i></a>
                    <a href="#"><i class="fas fa-heart"></i></a>
                    <a href="#" class="cart-icon"><i class="fas fa-shopping-bag"></i> <span class="cart-count">0</span></a>
                </div>
            </div>
            <nav class="navbar">
                <ul>
                    <li><a href="index.html">Trang chủ</a></li>
                    <li><a href="#">Sản phẩm</a></li>
                    <li><a href="#">Dịch vụ</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Event Banner -->
    <section class="event-banner">
        <div class="container">
            <img src="images/event-banner.jpg" alt="Banner sự kiện Mùa Hè Rực Rỡ" class="banner-image">
        </div>
    </section>

    <!-- Event Details -->
    <main class="event-details">
        <div class="container">
            <div class="event-header">
                <h1 class="event-title">Sự kiện Mùa Hè Rực Rỡ 2023</h1>
                <div class="event-meta">
                    <span class="event-date"><i class="far fa-calendar"></i> 15/06 - 30/08/2023</span>
                    <span class="event-location"><i class="fas fa-map-marker-alt"></i> Toàn hệ thống KChipSkyShop</span>
                </div>
            </div>

            <div class="event-content">
                <div class="event-description">
                    <h2>Giới thiệu sự kiện</h2>
                    <p>Chào đón mùa hè 2023, KChipSkyShop mang đến chương trình khuyến mãi đặc biệt với ưu đãi lên đến <strong>50%</strong> cho toàn bộ sản phẩm thuộc bộ sưu tập mùa hè. Đây là cơ hội để bạn sở hữu những thiết kế mới nhất với mức giá hấp dẫn!</p>
                    
                    <h3>Nội dung chương trình</h3>
                    <ul>
                        <li>Giảm <strong>30%</strong> toàn bộ áo thun, váy mùa hè</li>
                        <li>Giảm <strong>50%</strong> khi mua combo 2 sản phẩm</li>
                        <li>Tặng voucher <strong>200.000đ</strong> cho hóa đơn từ 1.500.000đ</li>
                    </ul>

                    <div class="event-highlight">
                        <i class="fas fa-gift"></i>
                        <p>Đặc biệt: Khách hàng mua sắm trong sự kiện sẽ nhận ngay một phiếu bốc thăm trúng thưởng với giải nhất là chuyến du lịch Bali!</p>
                    </div>
                </div>
            </div>

            <div class="event-gallery">
                <h2>Hình ảnh sự kiện</h2>
                <div class="gallery-grid" id="gallery">
                    <!-- Gallery items will be loaded by JavaScript -->
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>Giới thiệu</h3>
                    <p>ThatSkyShop - Thương hiệu thời trang với những sản phẩm chất lượng, phong cách trẻ trung, năng động.</p>
                </div>
                <div class="footer-col">
                    <h3>Liên kết</h3>
                    <ul>
                        <li><a href="index.html">Trang chủ</a></li>
                        <li><a href="#">Sản phẩm</a></li>
                        <li><a href="#">Khuyến mãi</a></li>
                        <li><a href="#">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Hỗ trợ</h3>
                    <ul>
                        <li><a href="#">Hướng dẫn mua hàng</a></li>
                        <li><a href="#">Chính sách đổi trả</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                        <li><a href="#">Điều khoản dịch vụ</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Liên hệ</h3>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> 123 Đường ABC, Quận 1, TP.HCM</li>
                        <li><i class="fas fa-phone"></i> 0123 456 789</li>
                        <li><i class="fas fa-envelope"></i> info@thatskyshop.com</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                </div>
                <div class="copyright">
                    <p>&copy; 2023 ThatSkyShop. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

     <!-- Cart Popup -->
<div class="cart-popup" id="cartPopup">
    <div class="cart-popup-content">
        <div class="cart-popup-header">
            <h3>Giỏ hàng của bạn</h3>
            <button class="close-cart">&times;</button>
        </div>
        <div class="cart-popup-items" id="cartItems">
            <!-- Cart items will be loaded here -->
        </div>
        <div class="cart-popup-summary">
            <div class="summary-row">
                <span>Tổng cộng</span>
                <span id="cartTotal">$0.00</span>
            </div>
            <p class="tax-note">Thuế và phí vận chuyển tính khi thanh toán</p>
            <button class="btn checkout-btn">Thanh toán</button>
            <button class="btn view-cart-btn">Xem giỏ hàng</button>
        </div>
    </div>
</div>
<script src="{{ asset('frontend/js/script.js') }}"></script>
    <script src="{{ asset('frontend/js/script.js') }}"></script>
</body>
</html>