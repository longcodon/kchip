// Dữ liệu mẫu
const cartItems = [
    { id: 1, name: "Love Boat Pin", price: 29.00, quantity: 1, image: "images/product1.jpg" },
    { id: 2, name: "Al Love Sky Purse", price: 35.00, quantity: 1, image: "images/product2.jpg" }
];

const SERVICE_FEE = 5.00;
const VALID_COUPONS = [
    { code: "KCIP10", discount: 10, type: "percent" },
    { code: "FREESHIP", discount: 5, type: "fixed" },
    { code: "MUSIC20", discount: 20, type: "percent", minOrder: 50 }
];

let appliedCoupon = null;

// Khởi tạo trang
document.addEventListener('DOMContentLoaded', function() {
    renderOrderItems();
    calculateTotal();
    
    // Sự kiện nút áp dụng mã
    document.getElementById('applyCouponBtn').addEventListener('click', applyCoupon);
    
    // Sự kiện thanh toán
    document.getElementById('checkoutBtn').addEventListener('click', processCheckout);
});

// Hiển thị sản phẩm trong giỏ hàng
function renderOrderItems() {
    const container = document.getElementById('orderItems');
    container.innerHTML = '';
    
    cartItems.forEach(item => {
        const itemElement = document.createElement('div');
        itemElement.className = 'order-item';
        itemElement.innerHTML = `
            <div class="item-info">
                <img src="${item.image}" alt="${item.name}">
                <div>
                    <h3>${item.name}</h3>
                    <p>$${item.price.toFixed(2)} × ${item.quantity}</p>
                </div>
            </div>
            <span class="item-price">$${(item.price * item.quantity).toFixed(2)}</span>
        `;
        container.appendChild(itemElement);
    });
}

// Áp dụng mã giảm giá
function applyCoupon() {
    const couponCode = document.getElementById('couponCode').value.trim();
    const messageEl = document.getElementById('couponMessage');
    const discountRow = document.getElementById('discountRow');
    
    // Reset
    messageEl.textContent = '';
    messageEl.className = 'coupon-message';
    discountRow.style.display = 'none';
    
    if (!couponCode) {
        showCouponMessage('Vui lòng nhập mã giảm giá', 'error');
        return;
    }
    
    const validCoupon = VALID_COUPONS.find(coupon => coupon.code === couponCode);
    
    if (!validCoupon) {
        showCouponMessage('Mã giảm giá không hợp lệ', 'error');
        return;
    }
    
    const subtotal = calculateSubtotal();
    if (validCoupon.minOrder && subtotal < validCoupon.minOrder) {
        showCouponMessage(`Áp dụng cho đơn hàng từ $${validCoupon.minOrder}`, 'error');
        return;
    }
    
    appliedCoupon = validCoupon;
    showCouponMessage('Áp dụng mã giảm giá thành công!', 'success');
    discountRow.style.display = 'flex';
    calculateTotal();
}

// Hiển thị thông báo mã giảm giá
function showCouponMessage(message, type) {
    const messageEl = document.getElementById('couponMessage');
    messageEl.textContent = message;
    messageEl.className = `coupon-message ${type}`;
}

// Tính tổng tiền
function calculateTotal() {
    const subtotal = calculateSubtotal();
    let discount = 0;
    
    if (appliedCoupon) {
        if (appliedCoupon.type === 'percent') {
            discount = subtotal * appliedCoupon.discount / 100;
        } else {
            discount = appliedCoupon.discount;
        }
    }
    
    const grandTotal = subtotal + SERVICE_FEE - discount;
    
    // Cập nhật giao diện
    document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById('fee').textContent = `$${SERVICE_FEE.toFixed(2)}`;
    
    if (appliedCoupon) {
        document.getElementById('discountAmount').textContent = `-$${discount.toFixed(2)}`;
        document.getElementById('discountRow').style.display = 'flex';
    } else {
        document.getElementById('discountRow').style.display = 'none';
    }
    
    document.getElementById('grandTotal').textContent = `$${grandTotal.toFixed(2)}`;
}

// Tính tổng phụ
function calculateSubtotal() {
    return cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
}

// Xử lý thanh toán
async function processCheckout() {
    const form = document.getElementById('paymentForm');
    const btn = document.getElementById('checkoutBtn');
    
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    const customerData = {
        name: document.getElementById('customerName').value,
        email: document.getElementById('customerEmail').value,
        facebook: document.getElementById('customerFB').value || 'Không cung cấp',
        note: document.getElementById('customerNote').value || 'Không có ghi chú',
        items: cartItems.map(item => `${item.name} x${item.quantity}`),
        subtotal: document.getElementById('subtotal').textContent,
        discount: appliedCoupon ? document.getElementById('discountAmount').textContent : 'Không có',
        total: document.getElementById('grandTotal').textContent,
        coupon: appliedCoupon ? appliedCoupon.code : null
    };
    
    // Hiệu ứng loading
    btn.classList.add('loading');
    btn.disabled = true;
    
    // Giả lập gửi dữ liệu
    await new Promise(resolve => setTimeout(resolve, 1500));
    
    // Tạo tin nhắn
    const message = `THÔNG TIN ĐƠN HÀNG\n\n` +
                   `Khách hàng: ${customerData.name}\n` +
                   `Email: ${customerData.email}\n` +
                   `Facebook: ${customerData.facebook}\n\n` +
                   `ĐƠN HÀNG:\n${customerData.items.join('\n')}\n\n` +
                   `Tạm tính: ${customerData.subtotal}\n` +
                   `Giảm giá: ${customerData.discount}\n` +
                   `Tổng cộng: ${customerData.total}\n\n` +
                   `Ghi chú: ${customerData.note}`;
    
    // Mở Messenger
    window.open(`https://m.me/yourpage?text=${encodeURIComponent(message)}`, '_blank');
    
    // Reset
    btn.classList.remove('loading');
    btn.disabled = false;
}






document.addEventListener('DOMContentLoaded', function() {
    // Xử lý hiển thị phương thức thanh toán
    const paymentMethods = document.querySelectorAll('input[name="paymentMethod"]');
    const paymentDetails = document.getElementById('paymentDetails');
    
    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            updatePaymentDetails(this.value);
        });
    });
    
    function updatePaymentDetails(method) {
        let details = '';
        
        switch(method) {
            case 'momo':
                details = `
                    <p><strong>Thanh toán qua Momo:</strong></p>
                    <p>Số điện thoại: <strong>0901234567</strong></p>
                    <p>Nội dung: <strong>KChip MãĐơnHàng</strong></p>
                    <p class="text-warning">Vui lòng chụp màn hình sau khi chuyển tiền</p>
                `;
                break;
                
            case 'bank':
                details = `
                    <p><strong>Chuyển khoản ngân hàng:</strong></p>
                    <p>Ngân hàng: <strong>Vietcombank</strong></p>
                    <p>Số tài khoản: <strong>123456789</strong></p>
                    <p>Tên tài khoản: <strong>NGUYEN VAN A</strong></p>
                    <p>Nội dung: <strong>KChip MãĐơnHàng</strong></p>
                `;
                break;
                
            case 'cod':
                details = `
                    <p><strong>Thanh toán khi nhận hàng (COD):</strong></p>
                    <p>Nhân viên sẽ liên hệ xác nhận đơn hàng</p>
                    <p class="text-warning">Áp dụng phí thu hộ 2% giá trị đơn hàng</p>
                `;
                break;
        }
        
        paymentDetails.innerHTML = details;
        paymentDetails.style.display = 'block';
    }
    
    // Kích hoạt phương thức mặc định
    updatePaymentDetails('momo');
    
    // Xử lý khi nhấn nút thanh toán
    const checkoutBtn = document.getElementById('checkoutBtn');
    checkoutBtn.addEventListener('click', function() {
        processPayment();
    });
    
    function processPayment() {
        // Validate form
        const name = document.getElementById('customerName').value;
        const email = document.getElementById('customerEmail').value;
        
        if (!name || !email) {
            alert('Vui lòng điền đầy đủ thông tin khách hàng');
            return;
        }
        
        // Lấy phương thức thanh toán
        const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
        
        // Tạo đơn hàng
        const orderData = {
            customerName: name,
            customerEmail: email,
            customerFB: document.getElementById('customerFB').value,
            customerNote: document.getElementById('customerNote').value,
            paymentMethod: paymentMethod,
            items: getCartItems(), // Hàm này lấy thông tin giỏ hàng
            total: calculateTotal() // Hàm tính tổng tiền
        };
        
        // Gửi đơn hàng đến server (AJAX)
        fetch('/api/orders', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(orderData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Chuyển hướng tùy phương thức thanh toán
                handlePaymentSuccess(data.orderId, paymentMethod);
            } else {
                alert('Có lỗi xảy ra: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi xử lý đơn hàng');
        });
    }
    
    function handlePaymentSuccess(orderId, method) {
        switch(method) {
            case 'momo':
                // Mở deep link Momo
                window.location.href = `momo://app?action=pay&phone=0901234567&amount=${totalAmount}&description=KChip_${orderId}`;
                break;
                
            case 'bank':
                // Hiển thị thông tin chuyển khoản chi tiết
                showBankTransferDetails(orderId);
                break;
                
            case 'cod':
                // Hiển thị thông báo thành công
                showOrderSuccess(orderId);
                break;
        }
    }
    
    function showBankTransferDetails(orderId) {
        // Hiển thị modal với thông tin chuyển khoản
        alert(`Đơn hàng #${orderId} đã được tạo. Vui lòng chuyển khoản theo thông tin bên trên và gửi biên lai cho chúng tôi.`);
    }
    
    function showOrderSuccess(orderId) {
        // Hiển thị thông báo thành công
        alert(`Đơn hàng #${orderId} đã được tạo thành công. Nhân viên sẽ liên hệ với bạn trong thời gian sớm nhất.`);
    }
    
    // Khởi tạo giỏ hàng (nếu chưa có)
    function getCartItems() {
        // Lấy từ localStorage hoặc biến global
        return JSON.parse(localStorage.getItem('cartItems')) || [];
    }
    
    function calculateTotal() {
        // Tính toán tổng tiền từ giỏ hàng
        const items = getCartItems();
        let subtotal = items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        
        // Áp dụng phí COD nếu có
        const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
        if (paymentMethod === 'cod') {
            return subtotal * 1.02; // +2% phí COD
        }
        
        return subtotal;
    }
});