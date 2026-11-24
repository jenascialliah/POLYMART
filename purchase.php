<?php require 'bootstrap.php'; if(empty($_SESSION['email'])){header('Location: login_page.php');exit;} require 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="<?= htmlspecialchars($_SESSION['csrf'], ENT_QUOTES) ?>">
<script src="auth.js"></script><script>sessionStorage.setItem('currentUser',<?= json_encode($_SESSION['email'],JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT) ?>);sessionStorage.setItem('currentUserData',JSON.stringify(<?= json_encode(profile($_SESSION['email']),JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT) ?>));</script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Account - PolyMart</title>
  <link rel="stylesheet" href="purchase.css" />
  <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700;900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body><div style="background:#fff1c4;color:#501515;text-align:center;padding:8px;font:14px sans-serif">Portfolio demo — use fictional details only. No real payments or deliveries.</div>
  <header>
    <div class="container">
    <div class="logo" aria-label="PolyMart logo">
        <img src="./elements/pm_logo.png" alt="PolyMart logo"
          width="32"
          height="32"
          style="display:block; border-radius: 15%;"
           />
        <span class="logo-text">PolyMart</span>
        
    </div>
    <nav aria-label="Primary navigation">
        <a href="main_pm.php#Home">Home</a>
        <button href="main_pm.php#Products">Products</button>
        <a href="main_pm.php#About">About</a>
        <a href="account.php">My Account</a>
    </nav>
    <div class="header-right">
        <form class="search-form" role="search" aria-label="Search products">
            <input type="text" class="search-input" placeholder="Search products..." aria-label="Search products" />
            <button type="submit" class="search-button" aria-label="Search"><i class="fas fa-search"></i></button>
        </form>
        <button onclick="window.location.href='cart.php'"  class="cart-button" aria-label="Cart"><i class="fas fa-shopping-cart"></i></button>
         <button onclick="logout()" class="cart-button" aria-label="Logout"><i class="fas fa-sign-out-alt"></i></button>
         <script>
  function logout() { polyLogout(); }
</script>
    </div>
    </div>
    
</header>
<section id="Home" class="hero" aria-label="Welcome hero section">
  <div class="hero-container">
    <video autoplay muted loop id="bg-video">
      <source src="elements/bg_moving5.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <div class="profile-form-container">
      <div class="profile-inner-container">

        <!-- Left Sidebar (Account Choice) -->
        <div class="account-choice">
          <div class="icon">
            <img src="elements/ic_sharp-account-circle.png" alt="icon">
            <span>User</span>
          </div>
          <div class="account-menu">
            <div class="menu-item" onclick="toggleAccountMenu()">
              <img src="elements/mdi_account-outline.png" alt="icon">
              <a href="#">My Account</a>
            </div>

            <!-- These will be toggled -->
            <div class="menu-item account-subitem" style="display: none;">
              <a href="account.php"><h2>Profile</h2></a>
            </div>
            <div class="menu-item account-subitem" style="display: none;">
              <a href="address.php"><h2>Addresses</h2></a>
            </div>
            <div class="menu-item account-subitem" style="display: none;">
              <a href="password.php"><h2>Change Password</h2></a>
            </div>

            <div class="menu-item">
              <img src="elements/lets-icons_order.png" alt="icon">
              <a href="purchase.php">My Purchases</a>
            </div>
          </div>
        </div>

        <script>
          function toggleAccountMenu() {
            const subItems = document.querySelectorAll('.account-subitem');
            subItems.forEach(item => {
              item.style.display = item.style.display === 'none' ? 'flex' : 'none';
            });
          }
        </script>

        <!-- Right Form Section -->
        <div class="form-section">
          <div class="order-scroll-wrapper">
          <div id="purchase-container" class="purchase-container" ></div>
          </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</section>


 
<footer aria-label="Site footer">
   
    <div class="footer-grid">
        <section class="footer-section" aria-label="About PolyMart">
            <h4>PolyMart</h4>
            <p>Your campus marketplace for buying and selling everything you need.</p>
            <div class="social-icons" role="list">
                <a href="#" aria-label="Instagram" role="listitem"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="Twitter" role="listitem"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Website" role="listitem"><i class="fas fa-globe"></i></a>
            </div>
        </section>
        <section class="footer-section footer-links" aria-label="Quick links">
            <h4>Quick Links</h4>
            <a href="#">Home</a>
            <a href="#">Categories</a>
            <a href="#">Sell Items</a>
            <a href="#">My Account</a>
            <a href="#">How It Works</a>
        </section>
        <section class="footer-section footer-links" aria-label="Help and support">
            <h4>Help & Support</h4>
            <a href="#">FAQs</a>
            <a href="#">Contact Us</a>
            <a href="#">Safety Tips</a>
            <a href="#">Terms of Service</a>
            <a href="#">Privacy Policy</a>
        </section>
        <section class="footer-section contact-info" aria-label="Contact information">
            <h4>Contact Info</h4>
            <p><i class="fas fa-map-marker-alt"></i> Student Union Building, Room 123 University Campus</p>
            <p><i class="fas fa-envelope"></i> <a href="mailto:supportpolymart@gmail.com">supportpolymart@gmail.com</a></p>
            <p><i class="fas fa-phone-alt"></i> (555) 123-456</p>
            
        </section>
    </div>
    <hr class="footer-divider" />
    <div class="footer-bottom container">
        <p>© 2025 PolyMart. All right reserved.</p>
        <div class="footer-logos" aria-label="Payment methods">
            <img src="https://storage.googleapis.com/a1aa/image/dd492ca8-0774-427c-c805-9d84170c4b07.jpg" alt="Visa logo in white on red background" width="70" height="70" loading="lazy" />
            <img src="https://storage.googleapis.com/a1aa/image/d06e3803-520a-47e7-1f67-1246c57eeb47.jpg" alt="PayPal logo in white on red background" width="70" height="70" loading="lazy" />
            <img src="https://storage.googleapis.com/a1aa/image/4d44df17-212d-4754-f350-245570609943.jpg" alt="Apple logo in white on red background" width="70" height="70" loading="lazy" />
        </div>
    </div>
</footer>
        

<script>
document.addEventListener("DOMContentLoaded", async () => {
  const currentUserEmail = sessionStorage.getItem("currentUser");

  if (!currentUserEmail) {
    alert("No user logged in.");
    window.location.href = "login_page.php";
    return;
  }

  try {
    const res = await fetch('get_user.php');
    const userData = await res.json();

    if (userData.error) throw new Error(userData.error);

    sessionStorage.setItem("currentUserData", JSON.stringify(userData));

    // ✨ Update UI
    const nameSpan = document.querySelector(".account-choice .icon span");
    if (nameSpan) {
      nameSpan.textContent = userData.username || `${userData.firstName} ${userData.lastName}`;
    }

    const sidebarIconImg = document.querySelector(".account-choice .icon img");
    if (sidebarIconImg && userData.profileImage) {
      sidebarIconImg.src = userData.profileImage;
    }

    // 👇 Optionally fill fields if needed (for account.php only)
    if (document.getElementById("profileImageInput")) {
      document.querySelector(".form-left input:nth-child(1)").value = userData.username || "";
      document.querySelector(".form-left input:nth-child(2)").value = `${userData.firstName || ""} ${userData.lastName || ""}`;
      document.querySelector(".form-left input:nth-child(3)").value = userData.email || "";
      document.querySelector(".form-left input:nth-child(4)").value = userData.phone || "";

      if (userData.profileImage) {
        document.querySelector(".avatar img").src = userData.profileImage;
      }
    }

  } catch (err) {
    console.error("❌ Failed to fetch user info:", err);
    alert("Unable to load user profile. Please try again.");
  }
});
</script>

</body>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const currentUser = sessionStorage.getItem("currentUser");
  const allOrders = JSON.parse(sessionStorage.getItem("polyOrders")) || [];
  const container = document.getElementById("purchase-container");

  const userOrders = allOrders.filter(order => order.user === currentUser);

  if (!userOrders.length) {
    container.innerHTML = "<p style='color: white;'>No purchases found.</p>";
    return;
  }

  container.innerHTML = ''; // Clear old contents

  userOrders.forEach(order => {
    const orderDiv = document.createElement("div");
    orderDiv.className = "order-box";

    const orderTotal = order.items.reduce((sum, i) => sum + i.price * i.quantity, 0) + 50;
    const date = new Date(order.date).toLocaleString();
    const deliveryDate = new Date(order.deliveryDate).toLocaleDateString();

    let itemList = order.items.map(item =>
      `<li>${esc(item.quantity)} × ${esc(item.name)} - ₱${esc(item.price)}</li>`
    ).join('');

    orderDiv.innerHTML = `
      <h3>Order #${esc(order.orderId)}</h3>
      <p><strong>Date Placed:</strong> ${esc(date)}</p>
      <p><strong>Delivery Date:</strong> ${esc(deliveryDate)}</p>
      <ul>${itemList}</ul>
      <p><strong>Total:</strong> ₱${esc(orderTotal)}</p>
      <p><em>Includes ₱50 shipping fee</em></p>
      <button class="delete-order-btn" data-id="${esc(order.orderId)}">Delete Order</button>
    `;

    container.appendChild(orderDiv);
  });

  // Event delegation for delete buttons
  container.addEventListener("click", function(e) {
    if (e.target.classList.contains("delete-order-btn")) {
      const orderId = parseInt(e.target.dataset.id);
      if (confirm(`Are you sure you want to delete order #${orderId}?`)) {
        const updatedOrders = allOrders.filter(order => order.orderId !== orderId);
        sessionStorage.setItem("polyOrders", JSON.stringify(updatedOrders));
        location.reload(); // refresh to show updated list
      }
    }
  });
});
</script>

</script>

<style>
.order-box {
  background: #ffe8bc;
  padding: 16px;
  margin-bottom: 16px;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(236, 198, 71, 0.1);
  font-family: 'Archivo', sans-serif;
  color: #333;
  font-size:medium;
}

.order-scroll-wrapper {
  max-height: 500px;
  overflow-y: auto;
  padding-right: 10px;
  border: none;
  border-radius: 10px;
  background: #fff;
  margin-top: 10px;
}

.delete-order-btn {
  background-color: #b81200;
  color: yellow;
  border: none;
  padding: 6px 12px;
  border-radius: 8px;
  cursor: pointer;
  margin-top: 10px;
  font-family: 'Archivo Narrow', sans-serif;
  font-size: medium;
}
.delete-order-btn:hover {
  background-color: white;
  border: 1px, solid, #b81200;
  color: #b81200;
}
</style>

</style>
</html>