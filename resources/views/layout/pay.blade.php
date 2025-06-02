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
                <a href="{{ route('index') }}">Trang chủ</a>
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
                            <input type="text" name='name' id="customerName" required>
                            @error("name")
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Email*</label>
                            <input type="email" name="email" id="customerEmail" required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Link Facebook (nếu có)</label>
                            <input type="url" name="fb" id="customerFB" placeholder="https://facebook.com/username">
                            @error('fb')
                            <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Ghi chú</label>
                            <textarea id="customerNote" name="note" rows="3"></textarea>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                        </div>
                    </form>
                </section>
                
                <!-- Đơn hàng -->
                <section class="order-summary">
                    <h2><i class="fas fa-receipt"></i> Đơn hàng</h2>
                    
                    <div class="order-items" id="orderItems">
@foreach ($danhmuc as $item)
 <div class="order-item">
            <div class="item-name">{{ $item->title  }}</div>
            <div class="item-price">{{ number_format($item->price, 0, ',', '.') }}đ</div>
        </div>
 @endforeach

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
                     <div class="payment-methods">
        <h3><i class="fas fa-credit-card"></i> Phương thức thanh toán</h3>
        <div class="method-options">
            <label class="method-option">
                <input type="radio" name="paymentMethod" value="momo" checked>
                <img src="frontend/images/momo.png" alt="Momo">
                <span>Ví Momo</span>
            </label>
            
            <label class="method-option">
                <input type="radio" name="paymentMethod" value="bank">
                <img src="frontend/images/bank.png" alt="Bank Transfer">
                <span>Chuyển khoản</span>
            </label>
            
            <label class="method-option">
                <input type="radio" name="paymentMethod" value="cod">
                <img src="frontend/images/cod.png" alt="COD">
                <span>Thanh toán khi nhận hàng</span>
            </label>
        </div>
        
        <!-- Hiển thị thông tin tùy chọn -->
        <div id="paymentDetails" class="payment-details">
            <!-- JS sẽ hiển thị thông tin tùy theo phương thức chọn -->
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
                   
<form id="paymentFormFinal" method="POST">
    @csrf
    <input type="hidden" name="price" value="{{ $price }}">
    <input type="hidden" name="name" id="finalName">
    <input type="hidden" name="email" id="finalEmail">
    <input type="hidden" name="fb" id="finalFB">
    <input type="hidden" name="note" id="finalNote">

    <button type="submit" id="finalPayBtn">Thanh toán</button>
</form>






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


    <script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('paymentFormFinal');
    const payBtn = document.getElementById('finalPayBtn');

    payBtn.addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn submit form mặc định

        // Lấy giá trị người dùng nhập
        const name = document.getElementById('customerName').value;
        const email = document.getElementById('customerEmail').value;
        const fb = document.getElementById('customerFB').value;
        const note = document.getElementById('customerNote').value;

        // Gán vào hidden inputs
        document.getElementById('finalName').value = name;
        document.getElementById('finalEmail').value = email;
        document.getElementById('finalFB').value = fb;
        document.getElementById('finalNote').value = note;

        // Xác định phương thức thanh toán
        const selectedMethod = document.querySelector('input[name="paymentMethod"]:checked').value;

        // Đặt action URL phù hợp
        let actionURL = "";
        switch (selectedMethod) {
            case "momo":
                actionURL = "{{ url('/momo_payment') }}";
                break;
            case "bank":
                actionURL = "{{ url('/bank_payment') }}";
                break;
            case "cod":
                actionURL = "{{ url('/cod_payment') }}";
                break;
            default:
                alert("Vui lòng chọn phương thức thanh toán.");
                return;
        }

        // Gán action cho form và submit
        form.action = actionURL;
        form.submit();
    });
});
</script>

</body>
</html>