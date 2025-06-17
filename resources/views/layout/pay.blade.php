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
                <span class="cart-count">{{ count($Giohang) }}</span>
            </div>
        </div>
    </header>

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
                            @error("name") <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Email*</label>
                            <input type="email" name="email" id="customerEmail" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Link Facebook (nếu có)</label>
                            <input type="url" name="fb" id="customerFB" placeholder="https://facebook.com/username">
                        </div>
                        <div class="form-group">
                            <label>Ghi chú</label>
                            <textarea id="customerNote" name="note" rows="3"></textarea>
                        </div>
                    </form>
                </section>

                <!-- Đơn hàng -->
                <section class="order-summary">
                    <h2><i class="fas fa-receipt"></i> Đơn hàng</h2>
                    <div class="order-items" id="orderItems">
                        @forelse ($Giohang as $item)
                            <div class="order-item">
                                <div class="item-info">
                                    <img src="{{ $item->img }}" alt="{{ $item->name }}" style="width: 50px;">
                                    <div>
                                        <h3>{{ $item->name }}</h3>
                                        <p>{{ number_format($item->price, 0, ',', '.') }}đ × {{ $item->quantity ?? 1 }}</p>
                                    </div>
                                </div>
                                <span class="item-price">{{ number_format($item->price * ($item->quantity ?? 1), 0, ',', '.') }}đ</span>
                            </div>
                        @empty
                            <p style="color: red;">Không có sản phẩm trong giỏ hàng.</p>
                        @endforelse
                    </div>

                    <!-- Mã giảm giá -->
                    <div class="discount-section">
                        <h3><i class="fas fa-tag"></i> Mã giảm giá</h3>
                        <div class="coupon-input">
                            <input type="text" id="couponCode" placeholder="Nhập mã giảm giá">
                            <button type="button" id="applyCouponBtn">Áp dụng</button>
                        </div>
                        <p id="couponMessage" class="coupon-message"></p>
                    </div>

                    <!-- Phương thức thanh toán -->
                    <div class="payment-methods">
                        <h3><i class="fas fa-credit-card"></i> Phương thức thanh toán</h3>
                        <div class="method-options">
                            <label class="method-option"><input type="radio" name="paymentMethod" value="momo" checked> <img src="frontend/images/momo.png"><span>Momo</span></label>
                                                       <label class="method-option"><input type="radio" name="paymentMethod" value="vnpay"> <img src="frontend/images/vnpay.png"><span>VNPAY</span></label>
                            {{-- <label class="method-option"><input type="radio" name="paymentMethod" value="bank"> <img src="frontend/images/bank.png"><span>Chuyển khoản</span></label> --}}
                            <label class="method-option"><input type="radio" name="paymentMethod" value="cod"> <img src="frontend/images/cod.png"><span>COD</span></label>

                        </div>
                        <div id="paymentDetails" class="payment-details"></div>
                    </div>

                    <!-- Tổng -->
                    <div class="order-total">
                        <div class="total-row">
                            <span>Tạm tính:</span>
                            <span id="subtotal">{{ number_format($price, 0, ',', '.') }}đ</span>
                        </div>
                        <div class="total-row">
                            <span>Phí dịch vụ:</span>
                            <span id="fee">5.000đ</span>
                        </div>
                        <div class="total-row" id="discountRow" style="display: none;">
                            <span>Tiền được giảm:</span>
                            <span id="discountAmount">-0đ</span>
                        </div>
                        <div class="total-row grand-total">
                            <span>Tổng cộng:</span>
                            <span id="grandTotal">{{ number_format($price + 5000, 0, ',', '.') }}đ</span>
                        </div>
                    </div>

                    <!-- Form thanh toán -->
                    <form id="paymentFormFinal" method="POST" action="javascript:void(0);">

                        @csrf
                        <input type="hidden" name="name" id="finalName">
                        <input type="hidden" name="email" id="finalEmail">
                        <input type="hidden" name="fb" id="finalFB">
                        <input type="hidden" name="note" id="finalNote">
                        <input type="hidden" name="total_vnpay" id="totalVnpayInput" value="{{ $price + 5000 }}">

                        <input type="hidden" name="price" value="{{ $price }}">
                        <input type="hidden" name="title" value="{{ $Giohang[0]->name ?? '' }}">
                        <input type="hidden" name="author" value="{{ $Giohang[0]->author ?? '' }}">
                        <input type="hidden" name="img" value="{{ $Giohang[0]->img ?? '' }}">
                        <button type="submit" id="finalPayBtn">Thanh toán</button>
                    </form>

                    <p class="secure-notice"><i class="fas fa-lock"></i> Chúng tôi bảo mật thông tin của bạn</p>
                </section>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>© 2023 KChip. All rights reserved.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

 <!-- Cuối file pay.blade.php -->
<script>
const VALID_COUPONS = {!! json_encode(
    $maList->map(function($ma) {
        return [
            'code' => strtoupper($ma->ma),
            'discount' => (int) $ma->maprice,
            'type' => 'percent'
        ];
    })->values()->all()
) !!};

let appliedCoupon = null;
const SERVICE_FEE = 5000;

function parseCurrency(value) {
    return parseInt(value.replace(/[^\d]/g, '')) || 0;
}

// ✅ Tính tổng tiền và trả về grandTotal
function calculateTotal() {
    const subtotal = parseCurrency(document.getElementById('subtotal').textContent);
    let discount = 0;

    if (appliedCoupon) {
        discount = appliedCoupon.type === 'percent'
            ? Math.floor(subtotal * appliedCoupon.discount / 100)
            : appliedCoupon.discount;
    }

    const grandTotal = subtotal + SERVICE_FEE - discount;

    document.getElementById('discountAmount').textContent = `-${discount.toLocaleString()}đ`;
    document.getElementById('grandTotal').textContent = `${grandTotal.toLocaleString()}đ`;
    document.getElementById('discountRow').style.display = appliedCoupon ? 'flex' : 'none';

    document.getElementById('totalVnpayInput').value = grandTotal;

    return grandTotal; // ✅ trả về tổng tiền
}

// Áp dụng mã giảm giá
function applyCoupon() {
    const code = document.getElementById('couponCode').value.trim().toUpperCase();
    const message = document.getElementById('couponMessage');

    message.textContent = '';
    message.style.color = 'red';

    if (!code) {
        message.textContent = 'Vui lòng nhập mã giảm giá.';
        return;
    }

    const found = VALID_COUPONS.find(coupon => coupon.code === code);
    if (!found) {
        message.textContent = 'Mã giảm giá không hợp lệ.';
        return;
    }

    appliedCoupon = found;
    message.textContent = `Áp dụng mã giảm ${found.discount}% thành công.`;
    message.style.color = 'green';
    calculateTotal();
}

document.addEventListener('DOMContentLoaded', () => {
    calculateTotal();

    document.getElementById('applyCouponBtn').addEventListener('click', applyCoupon);

    const payBtn = document.getElementById('finalPayBtn');
    payBtn.addEventListener('click', function(event) {
        event.preventDefault();

        // ✅ Gán dữ liệu khách hàng
        document.getElementById('finalName').value = document.getElementById('customerName').value;
        document.getElementById('finalEmail').value = document.getElementById('customerEmail').value;
        document.getElementById('finalFB').value = document.getElementById('customerFB').value;
        document.getElementById('finalNote').value = document.getElementById('customerNote').value;

        // ✅ Tính tổng tiền và gán
        const grandTotal = calculateTotal(); // lấy từ hàm luôn
        document.querySelector('input[name="price"]').value = grandTotal;
        document.querySelector('input[name="total_vnpay"]').value = grandTotal;

        // ✅ Chọn phương thức thanh toán
        const selectedMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
        let actionURL = "";

        switch (selectedMethod) {
            case "momo":
                actionURL = "{{ url('/momo_payment') }}";
                break;
            case "vnpay":
                actionURL = "{{ url('/vnpay_payment') }}";
                break;
            case "cod":
                actionURL = "{{ url('/cod_payment') }}";
                break;
            default:
                alert("Vui lòng chọn phương thức thanh toán.");
                return;
        }

        document.getElementById('paymentFormFinal').action = actionURL;

        setTimeout(() => {
            document.getElementById('paymentFormFinal').submit();
        }, 100);
    });
});
</script>

</body>
</html>
