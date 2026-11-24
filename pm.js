document.addEventListener('DOMContentLoaded', () => {
  const getStartedBtn = document.querySelector('.btn-get-started');
  const loader = document.getElementById('loader');

  if (getStartedBtn && loader) {
    getStartedBtn.addEventListener('click', () => {
      loader.classList.add('active'); // Show loader

      setTimeout(() => {
        window.location.href = "login_page.php"; // Redirect after delay
      }, 1500); 
    });
  }
});