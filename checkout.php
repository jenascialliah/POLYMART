<?php require __DIR__.'/bootstrap.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="guest.js"></script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Checkout - PolyMart</title>
  <link rel="stylesheet" href="checkout.css" />
  <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700;900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body><div class="demo-banner" style="background:#fff1c4;color:#501515;text-align:center;padding:8px;font:14px sans-serif">Portfolio demo — browse without signing in. No real payments or deliveries.</div>
  <header>
    <div class="container">
      <div class="logo">
        <img src="./elements/pm_logo.png" alt="PolyMart logo" width="32" height="32" style="display:block; border-radius: 15%;" />
        <span class="logo-text">PolyMart</span>
      </div>
      <nav>
        <a href="main_pm.php#Home">Home</a>
        <button onclick="window.location.href='main_pm.php#Products'">Products</button>
        <a href="main_pm.php#About">About</a>
        <a href="purchase.php">My Purchases</a>
      </nav>
      <div class="header-right">
        <form class="search-form">
          <input type="text" class="search-input" placeholder="Search products..." />
          <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
        </form>
        <button onclick="window.location.href='cart.php'" class="cart-button"><i class="fas fa-shopping-cart"></i></button>
        <button onclick="resetDemo()" class="cart-button" aria-label="Reset demo" title="Reset demo"><i class="fas fa-redo"></i></button>
      </div>
    </div>
    
  </header>


  
  
      <section class="hero" aria-label="Checkout Section" style="position: relative; overflow: hidden;">
  <video autoplay muted loop playsinline id="bg-video" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; object-fit: cover; z-index: -1;">
    <source src="elements/bg_moving5.mp4" type="video/mp4" />
    Your browser does not support the video tag.
  </video>

  <div class="cart-container" style="background-color: white; margin: 2rem auto; padding: 2rem; border-radius: 20px; width: 90%; max-width: 900px; box-shadow: 0 0 20px rgba(0,0,0,0.1); position: relative; z-index: 1;">
    <h1 class="cart-title">Checkout</h1>
    <p class="cart-breadcrumb">Home / Shopping Cart / <span>Checkout</span></p>

    <div class="delivery-address" style="background-color: #fff0d2; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
      <h3 style="margin: 0; font-weight: bold;"><i class="fas fa-map-marker-alt"></i> Delivery Address</h3>
      <p><strong id="checkout-name">Demo Guest</strong> <span id="checkout-phone">(Fictional)</span><br><span id="checkout-address">Sample Campus Address — not a real delivery</span></p>
    </div>

    <div class="products-ordered" style="background-color: #fff0d2; padding: 1rem; border-radius: 8px;">
      <h3 style="margin-bottom: 1rem;"><i class="fas fa-box"></i> Products Ordered</h3>
      <table class="cart-table">
        <thead>
          <tr>
            <th>Product</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Item Subtotal</th>
          </tr>
        </thead>
        <tbody id="checkout-items">
          <!-- Dynamic rows inserted by JS -->
        </tbody>
      </table>
    </div>
<div class="delivery-summary" style="margin-top: 1rem;">
  <p><i class="fas fa-truck"></i> <strong>Delivery Date:</strong> <br> Standard Local - 
    <span id="delivery-estimate" style="color: green;">Loading...</span>
  </p>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const today = new Date();
    const deliveryDate = new Date(today);
    deliveryDate.setDate(today.getDate() + 7);

    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = deliveryDate.toLocaleDateString(undefined, options);

    document.getElementById('delivery-estimate').textContent = `Demo delivery estimate: ${formattedDate}`;
  });
</script>

    <div class="payment-method" style="margin-top: 1rem;">
      <p><i class="fas fa-wallet"></i> <strong>Payment Method:</strong> <button disabled style="margin-left: 1rem; background: #fff; border: 1px solid #ccc; padding: 0.2rem 0.5rem;">Simulated payment</button></p>
    </div>

    <div class="order-summary" style="margin-top: 1rem; text-align: right;">
      <p>Merchandise Subtotal: <strong id="checkout-subtotal">₱0</strong></p>
      <p>Shipping Subtotal: <strong id="checkout-shipping">₱0</strong></p>
      <h2 style="color: #b40000; font-size: medium;">Order Total (<span id="checkout-items-count">0</span> Item): <strong id="checkout-total">₱0</strong></h2>
    </div>

    <div style="text-align: right; margin-top: 1rem;">
      <button class="checkout-btn" style="padding: 0.8rem 2rem; border: none; border-radius: 20px; background: #ffbc70; font-weight: bold; cursor: pointer; width: 250px;" onclick="placeOrder()">Place Demo Order</button>
    </div>
  </div>
</section>


<footer style="background-color: #8b0000; color: #facc15; font-size: 0.75rem; padding: 2.5rem 1rem; z-index: 5; position: relative;">
  <div class="footer-grid">
    <section class="footer-section">
      <h4>PolyMart</h4>
      <p>Your campus marketplace for buying and selling everything you need.</p>
      <div class="social-icons">
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fas fa-globe"></i></a>
      </div>
    </section>
    <section class="footer-section footer-links">
      <h4>Quick Links</h4>
      <a href="main_pm.php#Home">Home</a>
      <a href="main_pm.php#Categories">Categories</a>
      <span>Seller tools (not available in demo)</span>
      <a href="purchase.php">My Purchases</a>
      <a href="main_pm.php#About">How It Works</a>
    </section>
    <section class="footer-section footer-links">
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
document.addEventListener('DOMContentLoaded', async () => {
  const checkoutItemsContainer = document.getElementById('checkout-items');
  const subtotalField = document.getElementById('checkout-subtotal');
  const shippingField = document.getElementById('checkout-shipping');
  const totalField = document.getElementById('checkout-total');
  const itemCountField = document.getElementById('checkout-items-count');

  // Use fixed fictional delivery information. No personal information is collected.
  // Load cart items
  const cart = getCart();
  let totalItems = 0;
  let subtotal = 0;

  checkoutItemsContainer.innerHTML = ''; // Clear table first

  if (cart.length === 0) {
    checkoutItemsContainer.innerHTML = '<tr><td colspan="4" style="text-align:center;">Your cart is empty.</td></tr>';
  } else {
    cart.forEach(item => {
      const itemSubtotal = item.price * item.quantity;
      subtotal += itemSubtotal;
      totalItems += item.quantity;

      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${esc(item.name)}</td>
        <td>₱${esc(item.price)}</td>
        <td>${esc(item.quantity)}</td>
        <td>₱${esc(itemSubtotal)}</td>
      `;
      checkoutItemsContainer.appendChild(row);
    });
  }

  const shipping = subtotal > 0 ? 50 : 0;
  subtotalField.textContent = `₱${subtotal}`;
  shippingField.textContent = `₱${shipping}`;
  totalField.textContent = `₱${subtotal + shipping}`;
  itemCountField.textContent = totalItems;

  // ✅ Estimated delivery date
  const today = new Date();
  const deliveryDate = new Date(today);
  deliveryDate.setDate(today.getDate() + 7);
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  document.getElementById('delivery-estimate').textContent = `Demo delivery estimate: ${deliveryDate.toLocaleDateString(undefined, options)}`;
});

function placeOrder() {
  const cart = getCart();

  if (cart.length === 0) {
    alert("Your cart is empty.");
    return;
  }

  const orders = getOrders();

  const orderDate = new Date();
  const deliveryDate = new Date(orderDate);
  deliveryDate.setDate(deliveryDate.getDate() + 7); // 7 days delivery

  const newOrder = {
    items: cart,
    date: orderDate.toISOString(),
    deliveryDate: deliveryDate.toISOString(),
    orderId: Date.now(),
  };

  orders.push(newOrder);
  if (!saveList(ORDER_KEY,orders)) return;
  sessionStorage.removeItem(CART_KEY);

  alert("✅ Demo order saved. No payment or delivery.");
  window.location.href = "purchase.php";
}
</script>


</body>

</html>
