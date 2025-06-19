<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán | KChip</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="frontend/css/pay.css">
    <style>
body {
    background: #f6fafd;
    font-family: 'Segoe UI', Arial, sans-serif;
    color: #222;
    margin: 0;
    padding: 0;
}
.header {
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,157,222,0.07);
    padding: 0;
}
.header .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1100px;
    margin: 0 auto;
    padding: 18px 20px;
}
.logo {
    font-size: 2rem;
    font-weight: bold;
    color: #009dde;
    text-decoration: none;
    letter-spacing: 1px;
}
.header nav a {
    color: #222;
    text-decoration: none;
    margin: 0 18px;
    font-weight: 500;
    transition: color 0.2s;
}
.header nav a.active, .header nav a:hover {
    color: #009dde;
}
.cart-icon {
    position: relative;
    font-size: 1.5rem;
    color: #009dde;
}
.cart-count {
    position: absolute;
    top: -10px; right: -12px;
    background: #e74c3c;
    color: #fff;
    font-size: 13px;
    font-weight: bold;
    border-radius: 50%;
    padding: 2px 7px;
    min-width: 22px;
    text-align: center;
    line-height: 18px;
}
.payment-container .container {
    max-width: 1100px;
    margin: 32px auto;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 24px rgba(0,157,222,0.08);
    padding: 32px 24px;
}
.page-title {
    font-size: 2.2rem;
    color: #009dde;
    margin-bottom: 28px;
    text-align: center;
    font-weight: 700;
}
.payment-grid {
    display: flex;
    gap: 32px;
    flex-wrap: wrap;
}
.customer-info, .order-summary {
    flex: 1 1 340px;
    background: #fafdff;
    border-radius: 14px;
    padding: 28px 22px;
    box-shadow: 0 2px 8px rgba(0,157,222,0.04);
}
.customer-info h2, .order-summary h2 {
    font-size: 1.3rem;
    color: #009dde;
    margin-bottom: 18px;
    font-weight: 600;
}
.form-group {
    margin-bottom: 18px;
}
.form-group label {
    font-weight: 500;
    margin-bottom: 6px;
    display: block;
}
.form-group input, .form-group textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #cce6f6;
    border-radius: 7px;
    font-size: 1rem;
    background: #fff;
    margin-top: 3px;
    transition: border 0.2s;
}
.form-group input:focus, .form-group textarea:focus {
    border-color: #009dde;
    outline: none;
}
.invalid-feedback {
    color: #e74c3c;
    font-size: 0.95em;
    margin-top: 2px;
}
.order-items {
    margin-bottom: 18px;
}
.order-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 14px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eaf3fa;
}
.item-info {
    display: flex;
    align-items: center;
    gap: 12px;
}
.item-info img {
    border-radius: 8px;
    border: 1px solid #e0f7fa;
    width: 50px; height: 50px; object-fit: cover;
}
.item-info h3 {
    font-size: 1.05rem;
    margin: 0 0 2px 0;
    font-weight: 600;
}
.item-info p {
    margin: 0;
    color: #009dde;
    font-size: 0.98rem;
}
.item-price {
    font-weight: 600;
    color: #222;
    font-size: 1.05rem;
}
.discount-section {
    margin: 18px 0 10px 0;
    background: #f3fbff;
    border-radius: 8px;
    padding: 14px 12px;
}
.coupon-input {
    display: flex;
    gap: 8px;
    margin-bottom: 6px;
}
.coupon-input input {
    flex: 1;
    border-radius: 6px;
    border: 1px solid #cce6f6;
    padding: 8px 10px;
    font-size: 1rem;
}
.coupon-input button {
    background: linear-gradient(90deg, #00c3ff 0%, #00d084 100%);
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 8px 18px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}
.coupon-input button:hover {
    background: linear-gradient(90deg, #00d084 0%, #00c3ff 100%);
}
.coupon-message {
    font-size: 0.98em;
    min-height: 18px;
}
.payment-methods {
    margin: 18px 0 10px 0;
}
.method-options {
    display: flex;
    gap: 18px;
    flex-wrap: wrap;
}
.method-option {
    display: flex;
    align-items: center;
    gap: 7px;
    background: #fafdff;
    border: 1.5px solid #cce6f6;
    border-radius: 8px;
    padding: 7px 16px;
    cursor: pointer;
    font-weight: 500;
    transition: border 0.2s, box-shadow 0.2s;
}
.method-option input[type="radio"] {
    accent-color: #009dde;
    margin-right: 4px;
}
.method-option img {
    width: 28px; height: 28px; object-fit: contain;
}
.method-option:hover, .method-option input:checked + img {
    border-color: #009dde;
    box-shadow: 0 2px 8px rgba(0,157,222,0.08);
}
.order-total {
    margin-top: 18px;
    background: #fafdff;
    border-radius: 8px;
    padding: 14px 12px;
    box-shadow: 0 2px 8px rgba(0,157,222,0.04);
}
.total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 7px;
    font-size: 1.05rem;
}
.total-row.grand-total {
    font-size: 1.18rem;
    font-weight: 700;
    color: #009dde;
}
#discountRow {
    color: #e74c3c;
}
#grandTotal {
    font-size: 1.2em;
}
#finalPayBtn {
    width: 100%;
    margin-top: 18px;
    padding: 12px 0;
    background: linear-gradient(90deg, #00c3ff 0%, #00d084 100%);
    color: #fff;
    font-weight: 700;
    font-size: 1.1rem;
    border: none;
    border-radius: 7px;
    cursor: pointer;
    transition: background 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 8px rgba(0,157,222,0.08);
}
#finalPayBtn:hover {
    background: linear-gradient(90deg, #00d084 0%, #00c3ff 100%);
}
.secure-notice {
    margin-top: 14px;
    color: #009dde;
    font-size: 0.98em;
    display: flex;
    align-items: center;
    gap: 6px;
}
.footer {
    background: #fff;
    border-top: 1px solid #eaf3fa;
    margin-top: 40px;
    padding: 18px 0 0 0;
}
.footer .container {
    max-width: 1100px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}
.social-links a {
    color: #009dde;
    font-size: 1.3rem;
    margin-left: 12px;
    transition: color 0.2s;
}
.social-links a:hover {
    color: #e74c3c;
}
@media (max-width: 900px) {
    .payment-grid { flex-direction: column; gap: 18px; }
    .payment-container .container { padding: 18px 4px; }
    .customer-info, .order-summary { padding: 18px 8px; }
    .footer .container { flex-direction: column; gap: 10px; }
}
</style>
</head>
<body>
    <header class="header">
        <div class="container">
            <a href="index.html" class="logo">KChip</a>
            <nav>
                <a href="{{ route('index') }}">Trang chủ</a>
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
