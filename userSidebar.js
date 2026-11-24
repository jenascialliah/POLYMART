document.addEventListener("DOMContentLoaded", () => {
  const currentUserEmail = localStorage.getItem("currentUser");
  if (!currentUserEmail) return;

  const users = JSON.parse(localStorage.getItem("polyUsers")) || [];
  const currentUser = users.find(user => user.email === currentUserEmail);

  if (!currentUser) return;

  // Update name beside "User"
  const nameSpan = document.querySelector(".account-choice .icon span");
  if (nameSpan) {
    nameSpan.textContent = currentUser.username || `${currentUser.firstName} ${currentUser.lastName}`;
  }

  // Update profile image beside name
  const avatarImg = document.querySelector(".account-choice .icon img");
  if (avatarImg && currentUser.profileImage) {
    avatarImg.src = currentUser.profileImage;
  }
});
