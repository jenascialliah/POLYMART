document.addEventListener("DOMContentLoaded", () => {
  const currentUser = sessionStorage.getItem("currentUser");

  if (!currentUser) {
    alert("You must be logged in to access this page.");
    window.location.href = "login_page.php";
    return;
  }
});
document.addEventListener('DOMContentLoaded', () => {
  const myAccountLink = document.querySelector('.my-account-link'); // Add this class to your "My Account" element
  const loader = document.getElementById('loader');

  if (myAccountLink && loader) {
    myAccountLink.addEventListener('click', () => {
      loader.classList.add('active'); // Show loader

      setTimeout(() => {
        window.location.href = "account.php"; // Redirect after delay
      }, 1500);
    });
  }
});
document.addEventListener("DOMContentLoaded", function () {
  const categoryButtons = document.querySelectorAll(".category-button");
  const categorySections = document.querySelectorAll(".category-section");
  const allProductsSection = document.getElementById("all-products");

  categoryButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const category = button.getAttribute("data-category");

      // Toggle button active state
      categoryButtons.forEach((btn) => btn.classList.remove("active"));
      button.classList.add("active");

      // Hide all sections
      categorySections.forEach((section) => (section.style.display = "none"));
      allProductsSection.style.display = "none";

      // Show the selected category section
      if (category === "all") {
        allProductsSection.style.display = "grid";
      } else {
        document.getElementById(`${category}-section`).style.display = "grid";
      }
    });
  });
  
});

function filterProducts(category) {
  const sections = {
    all: ["products-list", "exam-products", "lifestyle-products", "merch-products"],
    exam: ["exam-products"],
    lifestyle: ["lifestyle-products"],
    merch: ["merch-products"],
    popular: ["all-products"]
  };

  // Get all sections
  const allSectionIds = ["all-products", "exam-products", "lifestyle-products", "merch-products"];

  allSectionIds.forEach(id => {
    const section = document.getElementById(id);
    if (sections[category].includes(id)) {
      section.classList.add("active");
    } else {
      section.classList.remove("active");
    }
  });

  // Scroll to products section
  const featuredSection = document.getElementById("Products");
  if (featuredSection) {
    featuredSection.scrollIntoView({ behavior: "smooth" });
  }
}
document.addEventListener("DOMContentLoaded", function () {
  const viewAllBtn = document.getElementById("view-all-btn");
  const allProductsSection = document.getElementById("merch-products");

  if (viewAllBtn && allProductsSection) {
    viewAllBtn.addEventListener("click", () => {
      smoothScrollTo(allProductsSection.offsetTop, 1000); // 1000ms = 1 second
    });
  }

  function smoothScrollTo(targetY, duration) {
    const startY = window.scrollY;
    const startTime = performance.now();

    function scrollStep(currentTime) {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / duration, 1);
      const easeInOut = progress < 0.5
        ? 2 * progress * progress
        : -1 + (4 - 2 * progress) * progress;

      window.scrollTo(0, startY + (targetY - startY) * easeInOut);

      if (progress < 1) {
        requestAnimationFrame(scrollStep);
      }
    }

    requestAnimationFrame(scrollStep);
  }
});

document.querySelectorAll(".view-item-btn").forEach(button => {
  button.addEventListener("click", () => {
    const name = button.getAttribute("data-name");
    const price = button.getAttribute("data-price");
    const description = button.getAttribute("data-description");
    const image = button.getAttribute("data-image");
console.log("Image path:", image);
    document.getElementById("modalName").textContent = name;
    document.getElementById("modalPrice").textContent = price;
    document.getElementById("modalDescription").textContent = description;
    document.getElementById("modalImage").src = image;

    document.getElementById("productModal").style.display = "flex";
  });
});

document.getElementById("closeModalBtn").addEventListener("click", () => {
  document.getElementById("productModal").style.display = "none";
});

document.querySelectorAll(".quantity-btn").forEach(btn => {
  btn.addEventListener("click", () => {
    const input = document.getElementById("quantity");
    let value = parseInt(input.value);
    const change = parseInt(btn.getAttribute("data-change"));
    if (value + change >= 1) {
      input.value = value + change;
    }
  });
});