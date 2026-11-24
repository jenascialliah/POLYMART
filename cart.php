<?php require __DIR__.'/bootstrap.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="guest.js"></script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shopping Cart - PolyMart</title>
  <link rel="stylesheet" href="cart.css" />
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
      <source src="elements/bg_moving5.mp4" type="video/mp4" />
      Your browser does not support the video tag.
    </video>

    <div class="profile-form-container">
      <!-- Shopping Cart -->
      <section class="cart-container">
        <h1 class="cart-title">Shopping Cart</h1>
        <p class="cart-breadcrumb">Home / <span>Shopping Cart</span></p>

        <div class="cart-layout">
            <div class="cart-table-wrapper">
          <table class="cart-table">
            <thead>
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody id="cart-items">
              <!-- Dynamic cart items will be inserted here -->
            </tbody>
          </table>
          </div>

          <div class="cart-summary">
            <h3>Order Summary</h3>
            <div class="summary-line">
              <span>Items</span>
              <span id="summary-items">0</span>
            </div>
            <div class="summary-line">
              <span>Sub Total</span>
              <span id="summary-subtotal">₱0</span>
            </div>
            <div class="summary-line">
              <span>Shipping</span>
              <span id="summary-shipping">₱0</span>
            </div>
            <hr />
            <div class="summary-line total">
              <span>Total</span>
              <span id="summary-total">₱0</span>
            </div>
            <button class="checkout-btn" onclick="proceedToCheckout()" >Proceed to Checkout</button>
          </div>
        </div>

        <button class="clear-cart">Clear Shopping Cart</button>
      </section>
      <!-- End of Shopping Cart -->
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
 <script>
  document.addEventListener('DOMContentLoaded', () => {
    const cartItemsContainer = document.getElementById('cart-items');
    const summaryItems = document.getElementById('summary-items');
    const summarySubtotal = document.getElementById('summary-subtotal');
    const summaryShipping = document.getElementById('summary-shipping');
    const summaryTotal = document.getElementById('summary-total');

    const cart = getCart();

    if (!cart.length) {
      cartItemsContainer.innerHTML = `<tr><td colspan="4" style="text-align:center;">Your cart is empty.</td></tr>`;
      return;
    }

    let totalItems = 0;
    let subtotal = 0;
    cartItemsContainer.innerHTML = '';

    cart.forEach(item => {
      const itemSubtotal = item.price * item.quantity;
      subtotal += itemSubtotal;
      totalItems += item.quantity;

      const row = document.createElement('tr');
      row.innerHTML = `
        <td class="product-info">
          <img src="${esc(item.image)}" alt="${esc(item.name)}" />
          <div class="product-details">
            <p class="product-name">${esc(item.name)}</p>
          </div>
        </td>
        <td>₱${esc(item.price)}</td>
        <td>${esc(item.quantity)}</td>
        <td>₱${esc(itemSubtotal)}</td>
      `;
      cartItemsContainer.appendChild(row);
    });

    const shipping = subtotal > 0 ? 50 : 0;

    summaryItems.textContent = totalItems;
    summarySubtotal.textContent = `₱${subtotal}`;
    summaryShipping.textContent = `₱${shipping}`;
    summaryTotal.textContent = `₱${subtotal + shipping}`;
  });

  // Clear cart function
  document.addEventListener('DOMContentLoaded', () => {
    const clearCartButton = document.querySelector('.clear-cart');
    if (clearCartButton) {
      clearCartButton.addEventListener('click', () => {
        
        if (confirm("Are you sure you want to clear your cart?")) {
          sessionStorage.removeItem(CART_KEY);
          location.reload();
        }
      });
    }
  });

  // Proceed to checkout button
  function proceedToCheckout() {
    if (!getCart().length) {alert("Your cart is empty.");return;}
    window.location.href = "checkout.php";
  }
</script>

</body>
</html>