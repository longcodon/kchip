// script.js

console.log("That Sky Shop clone is loaded!");

document.querySelectorAll(".product-card").forEach(card => {
  card.addEventListener("click", () => {
    alert("You clicked on: " + card.querySelector("p").innerText);
  });
});
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

// Toggle mobile menu
const menuToggle = document.getElementById("menu-toggle");
const mainNav = document.getElementById("main-nav");

menuToggle.addEventListener("click", () => {
  mainNav.classList.toggle("active");
});

const noticeToggle = document.getElementById("noticeToggle");
const noticeContent = document.getElementById("noticeContent");
const toggleIcon = document.querySelector(".toggle-icon");

noticeToggle.addEventListener("click", () => {
  noticeContent.classList.toggle("show");
  toggleIcon.classList.toggle("rotate");
});
window.addEventListener("scroll", () => {
    const header = document.querySelector("header");
    if (window.scrollY > 10) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  });
  
  window.addEventListener("scroll", () => {
    const header = document.querySelector("header");
    if (window.scrollY > 10) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  });

// xem ngay 
function openModal(name, image, description, price) {
    // Tạo giao diện hoặc hiển thị một modal với các thông tin trên
    alert(`${name}\n${description}\nGiá: ${price}`);
  }
// chi tiet sp
function openModal(name, img, desc, price, author, transcriber, videoUrl) {
    document.getElementById("modal-title").textContent = name;
    document.getElementById("modal-image").src = img;
    document.getElementById("modal-description").textContent = desc;
    document.getElementById("modal-price").textContent = price;
    document.getElementById("modal-author").textContent = author;
    document.getElementById("modal-transcriber").textContent = transcriber;
    document.getElementById("modal-video").src = videoUrl;
    document.getElementById("product-modal").style.display = "flex";
  }
  
  function closeModal() {
    document.getElementById("product-modal").style.display = "none";
    document.getElementById("modal-video").src = ""; // reset video
  }
  
  //coming soon

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

// giỏ hàng
const cart = [];

function toggleCart() {
  const overlay = document.getElementById("cartOverlay");
  overlay.style.display = overlay.style.display === "flex" ? "none" : "flex";
}

function addToCart(name, price, imgSrc,author = "Không rõ") {
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
    cart.push({ name, price, imgSrc, author }); // ✅ Thêm author vào
    
    renderCart();
  
    // Ẩn modal trước khi hiển thị thông báo
    closeModal();  // <--- đóng modal trước
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
    }, 200); // Đợi modal ẩn hẳn
  }
  
  

function removeFromCart(name) {
  const index = cart.findIndex(item => item.name === name);
  if (index !== -1) {
    cart.splice(index, 1);
    renderCart();
  }
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
  

function parsePrice(str) {
  return parseInt(str.replace(/[^\d]/g, "")) || 0;
}
document.querySelector('.add-cart-btn').addEventListener('click', () => {
    const name = document.getElementById('modal-title').textContent;
    const price = document.getElementById('modal-price').textContent;
    const imgSrc = document.getElementById('modal-image').src;
    const author = document.getElementById('modal-author').textContent; // ✅ lấy author từ modal

    addToCart(name, price, imgSrc, author); // ✅ truyền author vào
});




document.getElementById("cart-icon").addEventListener("click", toggleCart);

// MA GIAM GIA
const validCoupon = {
    code: "KCHIP10",
    discount: 10 // Giảm 10%
  };
  let appliedDiscount = 0;

  function applyCoupon() {
    const input = document.querySelector(".discount-code input");
    const code = input.value.trim();
  
    if (code === validCoupon.code) {
      appliedDiscount = validCoupon.discount;
  
      // Ẩn giỏ hàng tạm thời
      document.getElementById("cartOverlay").style.display = "none";
  
      Swal.fire({
        icon: 'success',
        title: 'Mã hợp lệ!',
        text: `Bạn đã được giảm ${validCoupon.discount}% tổng hóa đơn.`,
        confirmButtonText: 'OK',
        confirmButtonColor: '#009dde'
      }).then(() => {
        // Hiện lại giỏ hàng sau khi người dùng ấn OK
        document.getElementById("cartOverlay").style.display = "flex";
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
      });
    }
  
    renderCart();
  }
  




document.querySelector('.checkout-btn').addEventListener('click', () => {
  if (cart.length === 0) {
    Swal.fire("Giỏ hàng đang trống!");
    return;
  }
console.log("Đang gửi cart:", cart);
console.log("URL:", SAVE_CART_URL);

fetch(SAVE_CART_URL, {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
  },
  body: JSON.stringify({ items: cart })
})
.then(async (res) => {
  const text = await res.text();
  const data = JSON.parse(text);

  if (data.success) {
    // 🟢 Thay vì chờ người dùng ấn OK mới chuyển trang
    // bạn dùng setTimeout hoặc auto chuyển luôn:
    Swal.fire({
      icon: 'success',
      title: 'Thành công!',
      text: data.message,
      showConfirmButton: false,
      timer: 1500
    });

    // Tự động chuyển trang sau khi hiển thị thông báo 1.5 giây
    setTimeout(() => {
      window.location.href = PAY_URL;
    }, 1500);
  } else {
    Swal.fire('Thất bại!', data.message, 'error');
  }
})

.catch(err => {
  console.error("❌ FETCH ERROR:", err);
  Swal.fire('Lỗi kết nối!', 'Không thể gửi dữ liệu.', 'error');
});

});

