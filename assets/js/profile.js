// choose file
btnChoose = document.getElementById("choose-photo");
btnChoose.addEventListener("click", function () {
  document.getElementById("foto").click();
});

var btnChangePassword = document.getElementById("btnChangePassword");

btnChangePassword.addEventListener("click", function () {
  document.getElementById("formChangePassword").classList.remove("d-none");
});

// change password awal
function closeForm() {
  const formVerification = document.querySelector(".form-verification");
  formVerification.classList.add("d-none");
}
const formVal = document.forms["form-change"];
var passwordOld = document.getElementById("passwordOld");
var password1 = document.getElementById("password2");
var password2 = document.getElementById("password3");
// container
var confirmPassword = document.getElementById("confirm-password");
var newPassword = document.getElementById("new-password");

passwordOld.addEventListener("focusout", function () {
  inputPassOld();
});

passwordOld.addEventListener("input", function () {
  inputPassOld();
});

// password
// tambahkan event ketika keyboard ditulis
password1.addEventListener("focusout", function () {
  inputPassword1();
});
password1.addEventListener("input", function () {
  inputPassword1();
});

if (password1.value.length >= 8) {
  inputPassword1();
}

// confirmation password
password2.addEventListener("focusout", function () {
  inputPassword2();
});
password2.addEventListener("input", function () {
  inputPassword2();
});
if (password2.value != "") {
  inputPassword2();
}

if (passwordOld.value == "" || password1.value == "" || password2.value == "") {
  subValPOld = "1";
  subValP1 = "1";
  subValP2 = "1";
}
formVal.addEventListener("submit", function (e) {
  var validation = document.getElementById("validation");
  var loadingBtn = document.querySelector(".fa-spin-change");
  if (
    validation.value != "0" ||
    subValPOld == "1" ||
    subValP1 == "1" ||
    subValP2 == "1"
  ) {
    e.preventDefault();
    return;
  }
  loadingBtn.classList.remove("d-none");
});
// change password akhir
