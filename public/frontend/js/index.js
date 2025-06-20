// ✅ That Sky Shop - index.js
console.log("That Sky Shop clone is loaded!");

let currentIndex = 0;
const slides = document.querySelectorAll(".slide");
const dots = document.querySelectorAll(".dot");

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.toggle("active", i === index);
    dots[i]?.classList.toggle("active", i === index);
  });
  currentIndex = index;
}
setInterval(() => {
  const nextIndex = (currentIndex + 1) % slides.length;
  showSlide(nextIndex);
}, 5000);

// Menu toggle
const menuToggle = document.getElementById("menu-toggle");
menuToggle?.addEventListener("click", () => {
  document.getElementById("main-nav").classList.toggle("active");
});

// Scroll header
window.addEventListener("scroll", () => {
  const header = document.querySelector("header");
  header?.classList.toggle("scrolled", window.scrollY > 10);
});

// Thông báo toggle
const noticeToggle = document.getElementById("noticeToggle");
const noticeContent = document.getElementById("noticeContent");
const toggleIcon = document.querySelector(".toggle-icon");
noticeToggle?.addEventListener("click", () => {
  noticeContent?.classList.toggle("show");
  toggleIcon?.classList.toggle("rotate");
});

const cart = [];
let appliedDiscount = 0;

function toggleCart() {
  const overlay = document.getElementById("cartOverlay");
  if (overlay) overlay.style.display = overlay.style.display === "flex" ? "none" : "flex";
}

function parsePrice(str) {
  return parseInt(str.replace(/[^\d]/g, "")) || 0;
}

function renderCart() {
  const cartItems = document.getElementById("cartItems");
  const total = document.getElementById("cartTotal");

  cartItems.innerHTML = cart.map(item => `
    <div class="cart-item">
      <img src="${item.imgSrc}" alt="${item.name}" />
      <div class="cart-item-info">
        <div><strong>${item.name}</strong></div>
        <div>Giá: ${item.price}</div>
        <div>Số lượng: 1</div>
      </div>
      <div class="cart-item-actions">
        <button onclick="removeFromCart('${item.name}')">&minus;</button>
      </div>
    </div>
  `).join("");

  const sum = cart.reduce((acc, item) => acc + parsePrice(item.price), 0);
  const discounted = sum * (1 - appliedDiscount / 100);
  total.textContent = `${discounted.toLocaleString()} ₫`;
}

function removeFromCart(name) {
  const index = cart.findIndex(item => item.name === name);
  if (index !== -1) {
    cart.splice(index, 1);
    renderCart();
  }
}

function addToCart(name, price, imgSrc, author = "Không rõ") {
  const found = cart.find(item => item.name === name);
  if (found) {
    Swal.fire({ toast: true, position: 'bottom', icon: 'info', title: 'Sản phẩm đã có trong giỏ hàng!', showConfirmButton: false, timer: 2500 });
    return;
  }
  cart.push({ name, price, imgSrc, author });
  renderCart();

  fetch(SAVE_CART_URL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({ items: cart })
  })
  .then(async res => {
    const contentType = res.headers.get('content-type') || '';
    if (!res.ok) {
      if (res.status === 403) {
        const data = await res.json();
        throw new Error(data.message || 'Bạn cần đăng nhập để thực hiện thao tác này.');
      }
      const errorText = await res.text();
      throw new Error(errorText || 'Đã xảy ra lỗi không xác định.');
    }
    if (!contentType.includes('application/json')) {
      const text = await res.text();
      throw new Error('Phản hồi không hợp lệ từ server: ' + text);
    }
    return res.json();
  })
  .then(data => {
    if (!data.success) {
      Swal.fire('Lỗi!', data.message || 'Không thể thêm vào giỏ hàng', 'error');
      return;
    }
    closeModal();
    setTimeout(() => {
      Swal.fire({ toast: true, position: 'bottom', icon: 'success', title: 'Đã thêm vào giỏ hàng!', showConfirmButton: false, timer: 2000 });
    }, 200);
  })
.catch(err => {
  console.error("❌ Lỗi lưu giỏ hàng:", err);

  if (err.message.includes("đăng nhập") || err.message.includes("403")) {
    Swal.fire({
      toast: true,
      position: 'bottom',
      icon: 'info',
      title: 'Bạn cần đăng nhập để thêm vào giỏ hàng',
      showConfirmButton: false,
      timer: 2000
    });

    // ⏳ Tự động chuyển sau 2 giây
    setTimeout(() => {
      window.location.href = "/login";
    }, 2000);
  } else {
    Swal.fire('Lỗi!', err.message || 'Không thể thêm vào giỏ hàng', 'error');
  }
});

}

function openModal(name, img, desc, price, author, transcriber, videoUrl) {
  document.getElementById("modal-title").textContent = name;
  document.getElementById("modal-image").src = img;
  document.getElementById("modal-description").textContent = desc;
  document.getElementById("modal-price").textContent = price;
  document.getElementById("modal-author").textContent = author;
  document.getElementById("modal-transcriber").textContent = transcriber;
  document.getElementById("modal-video").src = videoUrl;
  document.getElementById("product-modal").style.display = "flex";
  document.querySelector(".add-cart-btn").onclick = () => addToCart(name, price, img, author);
}

function closeModal() {
  document.getElementById("product-modal").style.display = "none";
  document.getElementById("modal-video").src = "";
}

document.querySelectorAll('.coming-soon').forEach(item => {
  item.addEventListener('click', function (e) {
    e.preventDefault();
    Swal.fire({ icon: 'info', title: 'Thông báo', text: 'Chức năng đang được xây dựng. Vui lòng quay lại sau!', confirmButtonText: 'Đã hiểu', confirmButtonColor: '#009dde' });
  });
});

document.getElementById("cart-icon")?.addEventListener("click", () => {
  fetch("/get-cart")
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        renderCartFromServer(data.data);
        document.getElementById("cartOverlay").style.display = "flex";
      } else {
        alert("Không thể tải giỏ hàng!");
      }
    })
    .catch(err => console.error("Lỗi tải giỏ hàng:", err));
});

function renderCartFromServer(items) {
  const cartItemsEl = document.getElementById("cartItems");
  const cartTotalEl = document.getElementById("cartTotal");
  let total = 0;
  const html = items.map(item => {
    const price = parseInt(item.price);
    total += price;
    return `
      <div class="cart-item">
        <img src="${item.img}" alt="${item.name}" />
        <div class="cart-item-info">
          <div><strong>${item.name}</strong></div>
          <div>Giá: ${price.toLocaleString()} ₫</div>
          <div>Số lượng: 1</div>
        </div>
        <button class="cart-remove-btn" data-name="${item.name}">&times;</button>
      </div>
    `;
  }).join("");

  cartItemsEl.innerHTML = html || "<p>Chưa có sản phẩm.</p>";
  cartTotalEl.textContent = `${total.toLocaleString()} ₫`;
  bindRemoveButtons();
}

function applyCoupon() {
  const input = document.querySelector(".discount-code input");
  const code = input.value.trim();

  appliedDiscount = code === validCoupon.code ? validCoupon.discount : 0;
  document.getElementById("cartOverlay").style.display = "none";

  Swal.fire({
    icon: appliedDiscount ? 'success' : 'error',
    title: appliedDiscount ? 'Mã hợp lệ!' : 'Mã không hợp lệ',
    text: appliedDiscount ? `Bạn đã được giảm ${validCoupon.discount}% tổng hóa đơn.` : 'Vui lòng kiểm tra lại mã.',
    confirmButtonColor: appliedDiscount ? '#009dde' : '#f44336'
  }).then(() => {
    document.getElementById("cartOverlay").style.display = "flex";
    renderCart();
  });
}

const validCoupon = { code: "KCHIP10", discount: 10 };

function removeFromCartServer(productName) {
  fetch('/remove-cart', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({ name: productName })
  })
  .then(async res => {
    const contentType = res.headers.get("content-type") || "";
    if (!contentType.includes("application/json")) {
      const text = await res.text();
      throw new Error("Phản hồi không hợp lệ hoặc không phải JSON: " + text);
    }
    const data = await res.json();
    if (!data.success) throw new Error(data.message || "Thao tác thất bại");
    Swal.fire({ toast: true, position: 'bottom', icon: 'success', title: 'Đã xoá khỏi giỏ hàng', showConfirmButton: false, timer: 2000 });
    return fetch("/get-cart");
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) renderCartFromServer(data.data);
    else throw new Error("Không thể tải lại giỏ hàng");
  })
  .catch(err => {
    Swal.fire('Lỗi!', err.message || 'Lỗi xoá giỏ hàng.', 'error');
    console.error("❌ Lỗi xử lý:", err);
  });
}

function bindRemoveButtons() {
  document.querySelectorAll('.cart-remove-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      const name = this.dataset.name;
      removeFromCartServer(name);
    });
  });
}
