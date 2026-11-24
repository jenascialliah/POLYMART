<?php require 'bootstrap.php'; if(empty($_SESSION['email'])){header('Location: login_page.php');exit;} require 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="<?= htmlspecialchars($_SESSION['csrf'], ENT_QUOTES) ?>">
<script src="auth.js"></script><script>sessionStorage.setItem('currentUser',<?= json_encode($_SESSION['email'],JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT) ?>);sessionStorage.setItem('currentUserData',JSON.stringify(<?= json_encode(profile($_SESSION['email']),JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT) ?>));</script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Account - PolyMart</title>
  <link rel="stylesheet" href="account.css" />
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
        <button onclick="filterProducts('all')">Products</button>
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
      <h1>My Profile</h1>
      <p class="subtitle">Manage and protect your account</p>
      
      <div class="form-grid">
        <!-- Form Fields -->
        <div class="form-left">
  <div class="label-row">
  <label>
    <span>Username</span>
    <input type="text" placeholder="Enter username" />
  </label>
</div>

<div class="label-row">
  <label>
    <span>Name</span>
    <input type="text" placeholder="Enter full name" />
  </label>
</div>


<div class="label-row">
  <label>
    <span>Email</span>
    <input type="email" placeholder="Enter email" />
  </label>
</div>

<div class="label-row">
  <label>
    <span>Phone Number</span>
    <input type="tel" placeholder="Enter phone number" />
  </label>
</div>


  <!-- ✅ OUTSIDE any label -->
  <div class="save-btn-container">
    <button class="save-btn" type="button">Save</button>
  </div>
</div>

        
            

        <!-- Image Upload -->
        <div class="form-right">
          <div class="avatar">
            <img src="./elements/ic_sharp-account-circle.png" alt="Profile-image">
          </div>
          <input type="file" id="profileImageInput" accept="image/*" style="display: none;" />
<button class="select-btn" type="button" onclick="document.getElementById('profileImageInput').click()">Select Image</button>
          
        </div>
      </div>
    </div>

  </div>
</div>

   </div>
   
</section>
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
document.addEventListener("DOMContentLoaded", async () => {
  const currentUserEmail = sessionStorage.getItem("currentUser");

  if (!currentUserEmail) {
    alert("No user logged in.");
    window.location.href = "login_page.php";
    return;
  }

  // ✅ Always fetch the latest user data from server
  let currentUserData = null;
  try {
    const res = await fetch('get_user.php');
    currentUserData = await res.json();

    if (currentUserData.error) throw new Error(currentUserData.error);
    sessionStorage.setItem("currentUserData", JSON.stringify(currentUserData));
  } catch (err) {
    console.error("❌ Failed to fetch user data:", err);
    alert("Unable to load user profile.");
    return;
  }

  // DOM elements
  const nameSpan = document.querySelector(".account-choice .icon span");
  const sidebarIconImg = document.querySelector(".account-choice .icon img");
  const avatarImg = document.querySelector(".avatar img");
  const imageInput = document.getElementById("profileImageInput");

  // Input fields
  const inputs = document.querySelectorAll(".form-left input");
  const usernameInput = inputs[0];
  const nameInput = inputs[1];
  const emailInput = inputs[2];
  const phoneInput = inputs[3];

  // Fill fields
  usernameInput.value = currentUserData.username || "";
  nameInput.value = `${currentUserData.firstName || ""} ${currentUserData.lastName || ""}`;
  emailInput.value = currentUserData.email;
  phoneInput.value = currentUserData.phone || "";

  // Update name beside sidebar icon
  nameSpan.textContent = currentUserData.username || `${currentUserData.firstName} ${currentUserData.lastName}`;

  // Load profile image if available
  if (currentUserData.profileImage) {
    avatarImg.src = currentUserData.profileImage;
    sidebarIconImg.src = currentUserData.profileImage;
  }

  // Handle profile image preview
  let selectedImage = null;
  imageInput.addEventListener("change", () => {
    const file = imageInput.files[0];
    if (!file) return;
    if (!/^(image\/png|image\/jpeg|image\/webp)$/.test(file.type) || file.size > 1000000) { alert("Choose a PNG, JPEG or WebP under 1 MB."); return; }

    const reader = new FileReader();
    reader.onload = function (e) {
      selectedImage = e.target.result;
      avatarImg.src = selectedImage;
      sidebarIconImg.src = selectedImage;
    };
    reader.readAsDataURL(file);
  });

  // Save updated profile
  document.querySelector(".save-btn").addEventListener("click", () => {
    const newUsername = usernameInput.value.trim();
    const fullName = nameInput.value.trim();
    const newPhone = phoneInput.value.trim();

    let firstName = currentUserData.firstName;
    let lastName = currentUserData.lastName;

    if (fullName.includes(" ")) {
      const [first, ...rest] = fullName.split(" ");
      firstName = first;
      lastName = rest.join(" ");
    }

    const updatePayload = {
      email: currentUserData.email,
      username: newUsername || currentUserData.username,
      phone: newPhone || currentUserData.phone,
      firstName,
      lastName,
      profileImage: selectedImage || currentUserData.profileImage || ""
    };

    fetch("updateprofile.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(updatePayload)
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        sessionStorage.setItem("currentUserData", JSON.stringify(updatePayload));
        alert("✅ Profile updated successfully!");
        location.reload();
      } else {
        alert("❌ " + data.message);
      }
    })
    .catch(err => {
      console.error("Update error:", err);
      alert("An error occurred while updating profile.");
    });
  });
});
</script>

 
</body>
</html>