<?php require 'bootstrap.php'; if(empty($_SESSION['email'])){header('Location: login_page.php');exit;} require 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="<?= htmlspecialchars($_SESSION['csrf'], ENT_QUOTES) ?>">
<script src="auth.js"></script><script>sessionStorage.setItem('currentUser',<?= json_encode($_SESSION['email'],JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT) ?>);sessionStorage.setItem('currentUserData',JSON.stringify(<?= json_encode(profile($_SESSION['email']),JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT) ?>));</script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Address - PolyMart</title>
  <link rel="stylesheet" href="address.css" />
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

<main>
    
        <!-- Main Content -->
        <div class="form-section">
          <div class="form-section-header">
            <h1>My Addresses</h1>
          </div>
          <div>
            <button class="add-btn" onclick="openModal()"> + Add New Address</button>
          </div>
          
          
          <div id="address-list" style="margin-top: 20px;" class="address-list-scrollable"></div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- Hidden Modal for Address -->
<div id="addressModal" class="modal">
  <div class="modal-content">
    <h2>Edit Address</h2>
    <form id="address-form">
      <label>Full Name</label>
      <input type="text" id="fullName" required>

      <label>Phone Number</label>
      <input type="text" id="phone" required>

      <label>Region, Province, City, Barangay</label>
      <input type="text" id="region" required>

      <label>Postal Code</label>
      <input type="text" id="postal" required>

      <label>Street Name, Building, House No.</label>
      <input type="text" id="street" required>

      <div class="modal-actions">
        <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
        <button type="submit" class="submit-btn">Submit</button>
      </div>
    </form>
  </div>
</div>

<!-- Password Modal (example if you want it) -->
<div id="passwordModal" class="modal" style="display: none;">
  <div class="modal-content">
    <h2>Change Password</h2>
    <form onsubmit="changePassword(event)">
      <label>Current Password</label>
      <input type="password" id="currentPassword" required>

      <label>New Password</label>
      <input type="password" id="newPassword" required>

      <label>Confirm New Password</label>
      <input type="password" id="confirmPassword" required>

      <div class="modal-actions">
        <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
        <button type="submit" class="submit-btn">Submit</button>
      </div>
    </form>
  </div>
</div>


  </main>

 
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
  let userAddresses = [];
  let editingIndex = null;

  function openModal(index = null) {
    const modal = document.getElementById('addressModal');
    modal.style.display = 'flex';

    if (index !== null) {
      editingIndex = index;
      const address = userAddresses[index];
      document.getElementById('fullName').value = address.fullName;
      document.getElementById('phone').value = address.phone;
      document.getElementById('region').value = address.region;
      document.getElementById('postal').value = address.postal;
      document.getElementById('street').value = address.street;
    } else {
      editingIndex = null;
      document.querySelector('#addressModal form').reset();
    }
  }

  function closeModal() {
    document.getElementById('addressModal').style.display = 'none';
  }

  function saveAddress(event) {
    event.preventDefault();

    const address = {
      email: sessionStorage.getItem("currentUser"),
      fullName: document.getElementById("fullName").value,
      phone: document.getElementById("phone").value,
      region: document.getElementById("region").value,
      postal: document.getElementById("postal").value,
      street: document.getElementById("street").value,
    };

    fetch("save_address.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(address),
    })
      .then(res => res.json())
      .then((result) => {
        if (result.success) {
          alert("✅ Address saved successfully!");
          closeModal();
          loadUserAddresses(); // Refresh from DB
        } else {
          alert("❌ Failed to save address: " + result.message);
        }
      })
      .catch((err) => {
        console.error("Error:", err);
        alert("❌ Failed to connect to the server.");
      });
  }

  function deleteAddress(index) {
  const addressId = userAddresses[index].id;

  if (!confirm("Are you sure you want to delete this address?")) return;

  fetch("delete_address.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ id: addressId }),
  })
    .then(async res => {
      const text = await res.text(); // Read response as plain text
      try {
        const result = JSON.parse(text); // Try to parse JSON
        if (result.success) {
          alert("✅ Address deleted successfully!");
          loadUserAddresses(); // Refresh list
        } else {
          alert("❌ Failed to delete: " + (result.message || "Unknown error"));
        }
      } catch (err) {
        console.error("❌ JSON parse error:", err);
        console.error("Raw server response:", text);
        alert("❌ Server returned invalid response:\n" + text);
      }
    })
    .catch(err => {
      console.error("❌ Network/Fetch error:", err);
      alert("❌ Network error while deleting address.");
    });
}


  function renderAddresses() {
    const container = document.getElementById('address-list');
    container.innerHTML = '';

    userAddresses.forEach((addr, i) => {
      const box = document.createElement('div');
      box.style.border = 'none';
      box.style.borderRadius = '12px';
      box.style.padding = '16px';
      box.style.marginBottom = '12px';
      box.style.boxShadow = '0 2px 8px rgba(0,0,0,0.1)';
      box.style.backgroundColor = '#fff1c4';
      box.style.fontFamily = 'Archivo, sans-serif';
      box.style.color = '#333';

      box.innerHTML = `
        <p style="font-weight: bold; font-size: 18px;">${esc(addr.full_name)}</p>
        <p style="margin: 4px 0;">
          <i class="fas fa-phone-alt" style="color: maroon; margin-right: 6px;"></i>${esc(addr.phone)}
        </p>
        <p style="margin: 4px 0;">
          <i class="fas fa-map-marker-alt" style="color: maroon; margin-right: 6px;"></i>${esc(addr.region)}
        </p>
        <p style="margin: 4px 0;">
          <i class="fas fa-envelope" style="color: maroon; margin-right: 6px;"></i>${esc(addr.postal)}
        </p>
        <p style="margin: 4px 0;">
          <i class="fas fa-home" style="color: maroon; margin-right: 6px;"></i>${esc(addr.street)}
        </p>
        <div style="margin-top: 10px;">
          <button onclick="deleteAddress(${esc(i)})" style="padding: 6px 12px; background-color: #fff1c4; color: blue; border: none; cursor: pointer;">Delete</button>
        </div>
      `;

      container.appendChild(box);
    });
  }

  document.getElementById('address-form').addEventListener('submit', saveAddress);

  async function loadUserAddresses() {
    const currentUser = sessionStorage.getItem("currentUser");
    if (!currentUser) return;

    try {
      const res = await fetch('get_address.php');
      const result = await res.json();

      if (Array.isArray(result)) {
        userAddresses = result;
        renderAddresses();
      } else {
        console.error("Unexpected address response:", result);
      }
    } catch (err) {
      console.error("Failed to fetch addresses:", err);
      alert("❌ Failed to load addresses.");
    }
  }

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

      const nameSpan = document.querySelector(".account-choice .icon span");
      if (nameSpan) {
        nameSpan.textContent = userData.username || `${userData.firstName} ${userData.lastName}`;
      }

      const sidebarIconImg = document.querySelector(".account-choice .icon img");
      if (sidebarIconImg && userData.profileImage) {
        sidebarIconImg.src = userData.profileImage;
      }

    } catch (err) {
      console.error("❌ Failed to fetch user info:", err);
      alert("Unable to load user profile. Please try again.");
    }

    loadUserAddresses(); // 👈 finally call this to show addresses
  });
</script>


</body>
</html>