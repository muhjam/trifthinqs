// show password
function showPassword() {
  var x = document.querySelector(".showPassword1");
  var z = document.querySelector(".showPassword");
  if (x.type === "password") {
    z.classList.add("fa-eye");
    z.classList.remove("fa-eye-slash");
    x.type = "text";
    check();
  } else {
    z.classList.remove("fa-eye");
    z.classList.add("fa-eye-slash");
    x.type = "password";
    uncheck();
  }
}

// function showPassword2() {
//   var y = document.querySelector(".showPassword2");
//   if (document.querySelector(".showPassword3") === false) {
//     if (y.type === "password") {
//       y.type = "text";
//       check();
//     } else {
//       y.type = "password";
//       uncheck();
//     }
//   } else {
//     var z = document.querySelector(".showPassword3");
//     if (y.type === "password") {
//       y.type = "text";
//       z.type = "text";
//       check();
//     } else {
//       y.type = "password";
//       z.type = "password";
//       uncheck();
//     }
//   }
// }

// // tambahkan event ketika keyboard ditulis
// password2.addEventListener("keyup", function () {
//   if (password1.type === "password") {
//     password2.type = "password";
//   } else {
//     password2.type = "text";
//   }
// });

// cehcked
function check() {
  document.querySelector(".showPassword").checked = true;
}

function uncheck() {
  document.querySelector(".showPassword").checked = false;
}

// function login
function login() {
  var x = document.querySelector(".showPassword1");
  var y = document.querySelector(".showPassword2");
  var z = document.querySelector(".showPassword");
  x.type = "password";
  y.type = "password";
  z.classList.remove("fa-eye");
  z.classList.add("fa-eye-slash");
  const formLogin = document.querySelector(".form-login");
  formLogin.classList.remove("d-none");
  const formSignup = document.querySelector(".form-signup");
  formSignup.classList.add("d-none");
  document.querySelector(".showPassword").checked = false;
}
// function signup
function signup() {
  var x = document.querySelector(".showPassword1");
  var y = document.querySelector(".showPassword2");
  var z = document.querySelector(".showPassword");
  x.type = "password";
  y.type = "password";
  z.classList.remove("fa-eye");
  z.classList.add("fa-eye-slash");
  const formLogin = document.querySelector(".form-login");
  formLogin.classList.add("d-none");
  const formSignup = document.querySelector(".form-signup");
  formSignup.classList.remove("d-none");
  document.querySelector(".showPassword").checked = false;
}

function closeForm() {
  var x = document.querySelector(".showPassword1");
  var y = document.querySelector(".showPassword2");
  var z = document.querySelector(".showPassword");
  x.type = "password";
  y.type = "password";
  z.classList.remove("fa-eye");
  z.classList.add("fa-eye-slash");
  const formLogin = document.querySelector(".form-login");
  formLogin.classList.add("d-none");
  const formSignup = document.querySelector(".form-signup");
  formSignup.classList.add("d-none");
  document.querySelector(".showPassword").checked = false;
}

// signup ajax
// ambil elemen2 yang dibutuhkan
var email = document.getElementById("email2");
var username = document.getElementById("username");
var password1 = document.getElementById("password2");
var password2 = document.getElementById("password3");

// container
var confirmPassword = document.getElementById("confirm-password");

// tambahkan event ketika keyboard ditulis
password1.addEventListener("keyup", function () {
  // buat object ajax
  var xhr = new XMLHttpRequest();

  // cek kesiapan ajax
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      confirmPassword.innerHTML = xhr.responseText;
    }
  };

  // eksekusi ajax
  xhr.open("GET", "assets/ajax/signup.php?password1=" + password1.value, true);
  xhr.send();
});

if (password1.value.length >= 8) {
  // buat object ajax
  var xhr = new XMLHttpRequest();

  // cek kesiapan ajax
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      confirmPassword.innerHTML = xhr.responseText;
    }
  };

  // eksekusi ajax
  xhr.open("GET", "assets/ajax/signup.php?password1=" + password1.value, true);
  xhr.send();
}
function loadingBtn() {
  var loadingBtn = document.querySelector(".fa-circle-o-notch");
  loadingBtn.classList.remove("d-none");
}
