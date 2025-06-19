console.log("That Sky Shop clone is loaded!");

let currentIndex = 0;
const slides = document.querySelectorAll(".slide");
const dots = document.querySelectorAll(".dot");

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.toggle("active", i === index);
    dots[i].classList.toggle("active", i === index);
  });
  currentIndex = index;
}
function currentSlide(index) {
  showSlide(index);
}
setInterval(() => {
  const nextIndex = (currentIndex + 1) % slides.length;
  showSlide(nextIndex);
}, 5000);

// Mobile menu
document.getElementById("menu-toggle").addEventListener("click", () => {
  document.getElementById("main-nav").classList.toggle("active");
});

// Thông báo
const noticeToggle = document.getElementById("noticeToggle");
const noticeContent = document.getElementById("noticeContent");
const toggleIcon = document.querySelector(".toggle-icon");
noticeToggle.addEventListener("click", () => {
  noticeContent.classList.toggle("show");
  toggleIcon.classList.toggle("rotate");
});

window.addEventListener("scroll", () => {
  const header = document.querySelector("header");
  if (window.scrollY > 10) header.classList.add("scrolled");
  else header.classList.remove("scrolled");
});

// 👉 Giỏ hàng
const cart = [];
let appliedDiscount = 0;

function toggleCart() {
  const overlay = document.getElementById("cartOverlay");
  overlay.style.display = overlay.style.display === "flex" ? "none" : "flex";
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
    Swal.fire({
      toast: true,
      position: 'bottom',
      icon: 'info',
      title: 'Sản phẩm đã có trong giỏ hàng!',
      showConfirmButton: false,
      timer: 2500,
      timerProgressBar: true
    });
    return;
  }

  const newItem = { name, price, imgSrc, author };
  cart.push(newItem);
  renderCart();

  fetch(SAVE_CART_URL, {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
  },
  body: JSON.stringify({ items: cart }) // 👈 Gửi toàn bộ giỏ hàng
})

  .then(res => res.json())
  .then(data => {
    if (!data.success) {
      Swal.fire('Lỗi!', data.message, 'error');
    }
  })
  .catch(err => {
    console.error("❌ Lỗi lưu giỏ hàng:", err);
  });

  closeModal();
  setTimeout(() => {
    Swal.fire({
      toast: true,
      position: 'bottom',
      icon: 'success',
      title: 'Đã thêm vào giỏ hàng!',
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true
    });
  }, 200);
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

  document.querySelector(".add-cart-btn").onclick = () => {
    addToCart(name, price, img, author);
  };
}
function closeModal() {
  document.getElementById("product-modal").style.display = "none";
  document.getElementById("modal-video").src = "";
}

document.querySelectorAll('.coming-soon').forEach(item => {
  item.addEventListener('click', function (e) {
    e.preventDefault();
    Swal.fire({
      icon: 'info',
      title: 'Thông báo',
      text: 'Chức năng đang được xây dựng. Vui lòng quay lại sau!',
      confirmButtonText: 'Đã hiểu',
      confirmButtonColor: '#009dde'
    });
  });
});

document.getElementById("cart-icon").addEventListener("click", () => {
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
    .catch(err => {
      console.error("Lỗi tải giỏ hàng:", err);
    });
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
      </div>
    `;
  }).join("");

  cartItemsEl.innerHTML = html || "<p>Chưa có sản phẩm.</p>";
  cartTotalEl.textContent = `${total.toLocaleString()} ₫`;
}


// Mã giảm giá
const validCoupon = {
  code: "KCHIP10",
  discount: 10
};
function applyCoupon() {
  const input = document.querySelector(".discount-code input");
  const code = input.value.trim();

  if (code === validCoupon.code) {
    appliedDiscount = validCoupon.discount;
    document.getElementById("cartOverlay").style.display = "none";

    Swal.fire({
      icon: 'success',
      title: 'Mã hợp lệ!',
      text: `Bạn đã được giảm ${validCoupon.discount}% tổng hóa đơn.`,
      confirmButtonText: 'OK',
      confirmButtonColor: '#009dde'
    }).then(() => {
      document.getElementById("cartOverlay").style.display = "flex";
      renderCart();
    });

  } else {
    appliedDiscount = 0;
    document.getElementById("cartOverlay").style.display = "none";

    Swal.fire({
      icon: 'error',
      title: 'Mã không hợp lệ',
      text: 'Vui lòng kiểm tra lại mã giảm giá.',
      confirmButtonColor: '#f44336'
    }).then(() => {
      document.getElementById("cartOverlay").style.display = "flex";
      renderCart();
    });
  }
}
