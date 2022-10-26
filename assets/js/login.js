// signup ajax
// ambil elemen2 yang dibutuhkan
// SIGNUP AJAX
const formVal = document.forms["form-signup"];
var email = document.getElementById("email2");
var username = document.getElementById("username");
var password1 = document.getElementById("password2");
var password2 = document.getElementById("password3");
var containerV = document.getElementById("styleLogin");
// container
var confirmPassword = document.getElementById("confirm-password");

// username
username.addEventListener("focusout", function () {
  usernameV();
});

username.addEventListener("input", function () {
  usernameV();
});
if (username.value != "") {
  usernameV();
}

if (email.value == "") {
  subValN = "1";
}

// email
email.addEventListener("focusout", function () {
  emailV();
});
email.addEventListener("input", function () {
  emailV();
});
if (email.value.length != 0) {
  emailV();
}

if (email.value == "") {
  subValE = "1";
}

// password
// tambahkan event ketika keyboard ditulis
password1.addEventListener("focusout", function () {
  password1V();
});
password1.addEventListener("input", function () {
  password1V();
});
if (password1.value.length >= 8) {
  password1V();
}
if (password2.value == "") {
  subValP1 = "1";
}

// confirmation password
password2.addEventListener("focusout", function () {
  password2V();
});
password2.addEventListener("input", function () {
  password2V();
});
if (password2.value != "") {
  password2V();
}
if (password2.value == "") {
  subValP2 = "1";
}

formVal.addEventListener("submit", function (e) {
  var loadingBtn = document.querySelector(".fa-spin-signup");
  var subValEm = document.getElementById("subValE");
  if (
    subValN == "1" ||
    subValE == "1" ||
    subValEm.value != "0" ||
    subValP1 == "1" ||
    subValP2 == "1"
  ) {
    e.preventDefault();
    return;
  }

  loadingBtn.classList.remove("d-none");
});
