console.log("That Sky Shop clone is loaded!");

// Giỏ hàng lưu trên localStorage
function getCart() {
    return JSON.parse(localStorage.getItem('cart') || '[]');
}
function setCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Hiện/ẩn popup giỏ hàng
function toggleCart() {
    const overlay = document.getElementById('cartOverlay');
    if (overlay.style.display === 'flex') {
        overlay.style.display = 'none';
    } else {
        renderCart();
        overlay.style.display = 'flex';
    }
}

// Cập nhật số lượng sản phẩm trên icon giỏ hàng
function updateCartCount() {
    let cart = getCart();
    const countEl = document.getElementById('cart-count');
    if (countEl) countEl.innerText = cart.length;
}

// Render danh sách sản phẩm trong giỏ hàng với nút xóa mới
function renderCart() {
    let cart = getCart();
    let html = '';
    let total = 0;
    cart.forEach((item) => {
        let price = parseInt((item.price || '0').replace(/\D/g, '')) || 0;
        html += `
        <div class="cart-item" style="display:flex;align-items:center;margin-bottom:18px;border-bottom:1px solid #f3f3f3;padding-bottom:10px;">
            <img src="${item.image}" alt="" style="width:54px;height:54px;object-fit:cover;border-radius:8px;margin-right:12px;border:1px solid #e0f7fa;">
            <div style="flex:1;">
                <div style="font-weight:600;color:#222;font-size:15px;margin-bottom:2px;">${item.name}</div>
                <div style="color:#009dde;font-size:14px;">Giá: ${item.price}</div>
                <div style="color:#888;font-size:13px;">Số lượng: 1</div>
            </div>
            <button class="cart-remove-x" data-id="${item.id}" style="background:none;border:none;color:#e74c3c;font-size:22px;cursor:pointer;margin-left:8px;">&times;</button>
        </div>
        `;
        total += price;
    });
    if(cart.length === 0) html = '<div style="text-align:center;color:#888;">Chưa có sản phẩm nào trong giỏ.</div>';
    document.getElementById('cartItems').innerHTML = html;
    document.getElementById('cartTotal').innerText = total.toLocaleString() + ' ₫';
    updateCartCount();

    // Gán sự kiện xóa cho nút x mới
    document.querySelectorAll('.cart-remove-x').forEach(btn => {
        btn.onclick = function() {
            removeFromCart(this.getAttribute('data-id'));
        };
    });
}

// Xóa sản phẩm khỏi giỏ hàng
function removeFromCart(id) {
    let cart = getCart();
    cart = cart.filter(item => item.id != id);
    setCart(cart);
    renderCart();
}

// Khi trang load, cập nhật số lượng
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
    // Gán sự kiện mở popup cho icon giỏ hàng
    const cartIcon = document.getElementById('cart-icon');
    if (cartIcon) cartIcon.onclick = function() { toggleCart(); };
});