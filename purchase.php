<?php require __DIR__.'/bootstrap.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="guest.js"></script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Demo Purchases - PolyMart</title>
  <link rel="stylesheet" href="purchase.css" />
  <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700;900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body><div class="demo-banner" style="background:#fff1c4;color:#501515;text-align:center;padding:8px;font:14px sans-serif">Portfolio demo — browse without signing in. No real payments or deliveries.</div>
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
        <a href="main_pm.php#Products">Products</a>
        <a href="main_pm.php#About">About</a>
        <a href="purchase.php">My Purchases</a>
    </nav>
    <div class="header-right">
        <form class="search-form" role="search" aria-label="Search products">
            <input type="text" class="search-input" placeholder="Search products..." aria-label="Search products" />
            <button type="submit" class="search-button" aria-label="Search"><i class="fas fa-search"></i></button>
        </form>
        <button onclick="window.location.href='cart.php'"  class="cart-button" aria-label="Cart"><i class="fas fa-shopping-cart"></i></button>
         <button onclick="resetDemo()" class="cart-button" aria-label="Reset demo" title="Reset demo"><i class="fas fa-redo"></i></button>
         
    </div>
    </div>
    
</header>
<section id="Home" class="hero" aria-label="Welcome hero section">
  <div class="hero-container">
    <video autoplay muted loop playsinline id="bg-video">
      <source src="elements/bg_moving5.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <div class="profile-form-container">
      <div class="profile-inner-container">

        <!-- Left Sidebar (Account Choice) -->
        <div class="account-choice">
          <div class="icon">
            <img src="elements/ic_sharp-account-circle.png" alt="icon">
            <span>Demo Guest</span>
          </div>
          <div class="account-menu"><div class="menu-item"><a href="main_pm.php#Products">Browse Products</a></div><div class="menu-item"><a href="cart.php">Shopping Cart</a></div><div class="menu-item"><a href="purchase.php">My Purchases</a></div></div></div>

        <!-- Right Form Section -->
        <div class="form-section">
          <div class="order-scroll-wrapper">
          <div id="purchase-container" class="purchase-container" ></div>
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
            <a href="main_pm.php#Home">Home</a>
            <a href="main_pm.php#Categories">Categories</a>
            <span>Seller tools (not available in demo)</span>
            <a href="purchase.php">My Purchases</a>
            <a href="main_pm.php#About">How It Works</a>
        </section>
        <section class="footer-section footer-links" aria-label="Help and support">
            <h4>Help & Support</h4>
            <a href="#">FAQs</a>
            <a href="#">Contact Us</a>
            <a href="#">Safety Tips</a>
            <a href="#">Terms of Service</a>
            <a href="#">Privacy Policy</a>
        </section>
        <section class="footer-section"><h4>Portfolio Demo</h4><p>No real sales, payments or deliveries.</p></section>
    </div>
    <hr class="footer-divider" />
    <div class="footer-bottom container">
        <p>© 2025 PolyMart. All right reserved.</p>
        <p>Simulated checkout only.</p>
    </div>
</footer>
        



</body>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const allOrders = getOrders();
  const container = document.getElementById("purchase-container");

  const userOrders = allOrders;

  if (!userOrders.length) {
    container.innerHTML = "<p style='color: white;'>No demo purchases yet.</p>";
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
        if (!saveList(ORDER_KEY,updatedOrders)) return;
        location.reload(); // refresh to show updated list
      }
    }
  });
});
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
</html>