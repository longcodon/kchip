<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán | KChip</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="frontend/css/pay.css">
</head>
<body>
    <!-- Header (Giữ nguyên từ trang chủ) -->
    <header class="header">
        <div class="container">
            <a href="index.html" class="logo">KChip</a>
            <nav>
                <a href="{{ route('welcome') }}">Trang chủ</a>
                <a href="service.html">Dịch vụ</a>
                <a href="#" class="active">Thanh toán</a>
            </nav>
            <div class="cart-icon">
                <i class="fas fa-shopping-bag"></i>
                <span class="cart-count">2</span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="payment-container">
        <div class="container">
            <h1 class="page-title">Thanh Toán</h1>
            
            <div class="payment-grid">
                <!-- Thông tin khách hàng -->
                <section class="customer-info">
                    <h2><i class="fas fa-user"></i> Thông tin khách hàng</h2>
                    <form id="paymentForm">
                        <div class="form-group">
                            <label>Họ tên*</label>
                            <input type="text" id="customerName" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Email*</label>
                            <input type="email" id="customerEmail" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Link Facebook (nếu có)</label>
                            <input type="url" id="customerFB" placeholder="https://facebook.com/username">
                        </div>
                        
                        <div class="form-group">
                            <label>Ghi chú</label>
                            <textarea id="customerNote" rows="3"></textarea>
                        </div>
                    </form>
                </section>
                
                <!-- Đơn hàng -->
                <section class="order-summary">
                    <h2><i class="fas fa-receipt"></i> Đơn hàng</h2>
                    
                    <div class="order-items" id="orderItems">
                        <!-- JS sẽ render ở đây -->
                    </div>
                    
                    <!-- Phần mã giảm giá mới thêm -->
                    <div class="discount-section">
                        <h3><i class="fas fa-tag"></i> Mã giảm giá</h3>
                        <div class="coupon-input">
                            <input type="text" id="couponCode" placeholder="Nhập mã giảm giá">
                            <button id="applyCouponBtn">Áp dụng</button>
                        </div>
                        <p id="couponMessage" class="coupon-message"></p>
                        <div class="discount-row" id="discountRow" style="display: none;">
                            <span>Giảm giá:</span>
                            <span id="discountAmount">-$0.00</span>
                        </div>
                    </div>
                    
                    <div class="order-total">
                        <div class="total-row">
                            <span>Tạm tính:</span>
                            <span id="subtotal">$0.00</span>
                        </div>
                        <div class="total-row">
                            <span>Phí dịch vụ:</span>
                            <span id="fee">$0.00</span>
                        </div>
                        <div class="total-row grand-total">
                            <span>Tổng cộng:</span>
                            <span id="grandTotal">$0.00</span>
                        </div>
                    </div>
                    
                    <button id="checkoutBtn" class="place-order-btn">
                        <i class="fab fa-facebook-messenger"></i> Liên hệ qua Fanpage
                    </button>
                    <p class="secure-notice">
                        <i class="fas fa-lock"></i> Chúng tôi bảo mật thông tin của bạn
                    </p>
                </section>
            </div>
        </div>
    </main>

    <!-- Footer (Giữ nguyên từ trang chủ) -->
    <footer class="footer">
        <div class="container">
            <p>© 2023 KChip. All rights reserved.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <script src="frontend/js/pay.js"></script>
</body>
</html>