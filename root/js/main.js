document.addEventListener("DOMContentLoaded", function () {
  var loginModal = document.getElementById("loginModal");
  var registerModal = document.getElementById("registerModal");

  var loginBtn = document.getElementById("loginBtn");
  var registerBtn = document.getElementById("registerBtn");

  var closeLogin = document.getElementById("closeLogin");
  var closeRegister = document.getElementById("closeRegister");

  loginBtn.onclick = function () {
    loginModal.style.display = "block";
  };

  registerBtn.onclick = function () {
    registerModal.style.display = "block";
  };

  closeLogin.onclick = function () {
    loginModal.style.display = "none";
  };

  closeRegister.onclick = function () {
    registerModal.style.display = "none";
  };

  window.onclick = function (event) {
    if (event.target == loginModal) {
      loginModal.style.display = "none";
    }
    if (event.target == registerModal) {
      registerModal.style.display = "none";
    }
  };
});
