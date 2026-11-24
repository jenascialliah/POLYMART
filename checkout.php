<?php require 'bootstrap.php'; if(empty($_SESSION['email'])){header('Location: login_page.php');exit;} require 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="<?= htmlspecialchars($_SESSION['csrf'], ENT_QUOTES) ?>">
<script src="auth.js"></script><script>sessionStorage.setItem('currentUser',<?= json_encode($_SESSION['email'],JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT) ?>);sessionStorage.setItem('currentUserData',JSON.stringify(<?= json_encode(profile($_SESSION['email']),JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT) ?>));</script>
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
<body><div style="background:#fff1c4;color:#501515;text-align:center;padding:8px;font:14px sans-serif">Portfolio demo — use fictional details only. No real payments or deliveries.</div>
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
        <a href="account.php">My Account</a>
      </nav>
      <div class="header-right">
        <form class="search-form">
          <input type="text" class="search-input" placeholder="Search products..." />
          <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
        </form>
        <button onclick="window.location.href='cart.php'" class="cart-button"><i class="fas fa-shopping-cart"></i></button>
        <button onclick="logout()" class="cart-button"><i class="fas fa-sign-out-alt"></i></button>
      </div>
    </div>
    <script>
      function logout() { polyLogout(); }
    </script>
  </header>


  
  
      <section class="hero" aria-label="Checkout Section" style="position: relative; overflow: hidden;">
  <video autoplay muted loop id="bg-video" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; object-fit: cover; z-index: -1;">
    <source src="elements/bg_moving5.mp4" type="video/mp4" />
    Your browser does not support the video tag.
  </video>

  <div class="cart-container" style="background-color: white; margin: 2rem auto; padding: 2rem; border-radius: 20px; width: 90%; max-width: 900px; box-shadow: 0 0 20px rgba(0,0,0,0.1); position: relative; z-index: 1;">
    <h1 class="cart-title">Checkout</h1>
    <p class="cart-breadcrumb">Home / Shopping Cart / <span>Checkout</span></p>

    <div class="delivery-address" style="background-color: #fff0d2; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
      <h3 style="margin: 0; font-weight: bold;"><i class="fas fa-map-marker-alt"></i> Delivery Address</h3>
      <p><strong id="checkout-name">John Doe</strong> <span id="checkout-phone">(+63) 1234567891</span><br><span id="checkout-address">Sta. Mesa, Metro, Manila, Metro Manila, 1016</span></p>
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
      <p><i class="fas fa-wallet"></i> <strong>Payment Method:</strong> <button disabled style="margin-left: 1rem; background: #fff; border: 1px solid #ccc; padding: 0.2rem 0.5rem;">Cash on Delivery</button></p>
    </div>

    <div class="order-summary" style="margin-top: 1rem; text-align: right;">
      <p>Merchandise Subtotal: <strong id="checkout-subtotal">₱0</strong></p>
      <p>Shipping Subtotal: <strong id="checkout-shipping">₱0</strong></p>
      <h2 style="color: #b40000; font-size: medium;">Order Total (<span id="checkout-items-count">0</span> Item): <strong id="checkout-total">₱0</strong></h2>
    </div>

    <div style="text-align: right; margin-top: 1rem;">
      <button class="checkout-btn" style="padding: 0.8rem 2rem; border: none; border-radius: 20px; background: #ffbc70; font-weight: bold; cursor: pointer; width: 250px;" onclick="placeOrder()">Place Order</button>
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
      <a href="#">Home</a>
      <a href="#">Categories</a>
      <a href="#">Sell Items</a>
      <a href="#">My Account</a>
      <a href="#">How It Works</a>
    </section>
    <section class="footer-section footer-links">
      <h4>Help & Support</h4>
      <a href="#">FAQs</a>
      <a href="#">Contact Us</a>
      <a href="#">Safety Tips</a>
      <a href="#">Terms of Service</a>
      <a href="#">Privacy Policy</a>
    </section>
    <section class="footer-section contact-info">
      <h4>Contact Info</h4>
      <p><i class="fas fa-map-marker-alt"></i> Student Union Building, Room 123 University Campus</p>
      <p><i class="fas fa-envelope"></i> <a href="mailto:supportpolymart@gmail.com">supportpolymart@gmail.com</a></p>
      <p><i class="fas fa-phone-alt"></i> (555) 123-456</p>
    </section>
  </div>
  <hr class="footer-divider" />
  <div class="footer-bottom container">
    <p>© 2025 PolyMart. All right reserved.</p>
    <div class="footer-logos">
      <img src="https://storage.googleapis.com/a1aa/image/dd492ca8-0774-427c-c805-9d84170c4b07.jpg" alt="Visa logo" width="70" height="70" />
      <img src="https://storage.googleapis.com/a1aa/image/d06e3803-520a-47e7-1f67-1246c57eeb47.jpg" alt="PayPal logo" width="70" height="70" />
      <img src="https://storage.googleapis.com/a1aa/image/4d44df17-212d-4754-f350-245570609943.jpg" alt="Apple logo" width="70" height="70" />
    </div>
  </div>
</footer>
<script>
document.addEventListener('DOMContentLoaded', async () => {
  const checkoutItemsContainer = document.getElementById('checkout-items');
  const subtotalField = document.getElementById('checkout-subtotal');
  const shippingField = document.getElementById('checkout-shipping');
  const totalField = document.getElementById('checkout-total');
  const itemCountField = document.getElementById('checkout-items-count');

  const currentUserEmail = sessionStorage.getItem("currentUser");
  if (!currentUserEmail) {
    alert("No user is currently logged in.");
    window.location.href = "login_page.php";
    return;
  }

  // ✅ Fetch user data (including addresses) from server
  let currentUserData = null;
  try {
    const response = await fetch('get_user.php');
    currentUserData = await response.json();

    if (currentUserData.error) throw new Error(currentUserData.error);

    sessionStorage.setItem("currentUserData", JSON.stringify(currentUserData));
  } catch (error) {
    console.error("❌ Error fetching user data:", error);
    alert("Failed to load your user data.");
    return;
  }

  // ✅ Extract and display delivery info
  const addresses = currentUserData.addresses || [];
  const primaryAddress = addresses.length > 0 ? addresses[0] : null;

  const name = primaryAddress?.full_name || currentUserData.username || `${currentUserData.firstName} ${currentUserData.lastName}`;
  const phone = primaryAddress?.phone || currentUserData.phone || "No phone available";
  const addressText = primaryAddress
    ? `${primaryAddress.street}, ${primaryAddress.region}, ${primaryAddress.postal}`
    : 'Sta. Mesa, Metro, Manila, Metro Manila, 1016';

  document.getElementById('checkout-name').textContent = name;
  document.getElementById('checkout-phone').textContent = phone;
  document.getElementById('checkout-address').textContent = addressText;

  // ✅ Load cart items
  const cart = JSON.parse(sessionStorage.getItem(`cart_${currentUserEmail}`)) || [];
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
  const currentUserEmail = sessionStorage.getItem("currentUser");
  const cart = JSON.parse(sessionStorage.getItem(`cart_${currentUserEmail}`)) || [];

  if (cart.length === 0) {
    alert("Your cart is empty.");
    return;
  }

  const orders = JSON.parse(sessionStorage.getItem("polyOrders")) || [];

  const orderDate = new Date();
  const deliveryDate = new Date(orderDate);
  deliveryDate.setDate(deliveryDate.getDate() + 7); // 7 days delivery

  const newOrder = {
    user: currentUserEmail,
    items: cart,
    date: orderDate.toISOString(),
    deliveryDate: deliveryDate.toISOString(),
    orderId: Date.now(),
  };

  orders.push(newOrder);
  sessionStorage.setItem("polyOrders", JSON.stringify(orders));
  sessionStorage.removeItem(`cart_${currentUserEmail}`);

  alert("✅ Demo order saved. No payment or delivery.");
  window.location.href = "purchase.php";
}
</script>


</body>

</html>
