<?php require __DIR__.'/bootstrap.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="guest.js"></script>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>PolyMart</title>

  <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700;900&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="style.css" rel="stylesheet" />
</head>
<body><div style="background:#fff1c4;color:#501515;text-align:center;padding:8px;font:14px sans-serif">Portfolio demo — no sign-in, real payments or deliveries.</div>
  <header>
    <nav>
      <div class="logo-container">
        <img
          src="elements/pm_logo.png"
          alt="PolyMart logo"
          width="32"
          height="32"
          style="display:block; border-radius: 15%;"
        />
        <span class="logo-text">PolyMart</span>
      </div>
      <ul class="nav-links">
        <li><a href="main_pm.php#Home">Home</a></li>
        <li><a href="main_pm.php#Categories">Categories</a></li>
        <li><a href="main_pm.php#About">About</a></li>
        <li><a href="purchase.php">My Purchases</a></li>
      </ul>
      <div class="search-cart">
        <form class="search-form" role="search" aria-label="Search products">
            <input type="text" class="search-input" placeholder="Search products..." aria-label="Search products" />
            <button type="submit" class="search-button" aria-label="Search"><i class="fas fa-search"></i></button>
        </form>
        </div>
        <button class="cart-button" aria-label="Shopping cart" onclick="location.href='cart.php'">
          <i class="fas fa-shopping-cart"></i>
        </button>
      </div>
    </nav>
  </header>
  <main>
    <section class="text-section">
      <video autoplay muted loop playsinline id="bg-video">
  <source src="elements/bg_moving5.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>
      <h1 class="headline">
        <span style="font-weight: 900;">A</span>
        <span class="highlight"> smarter</span><br />
        way for students<br />
        to buy and sell
      </h1>
      <p class="subtext">
        Your campus marketplace for buying and selling everything you need.
        Easy, Fast and student-friendly!
      </p>
      <button class="btn-get-started">Browse Products</button>
    <div class="loader-overlay" id="loader">
    <div class="spinner"></div>
    </div>
    </section>
    <section class="image-section">
      <img
        src="elements/market.png"
        alt="PolyMart Market"
        width="600"
        height="400"
      />
    </section>
  </main>
  <script src="pm.js"></script>
  
  
</body>
</html>
