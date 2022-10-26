function login() {
  const formVerification = document.querySelector(".form-verification");
  formVerification.classList.remove("d-none");
}

function closeForm() {
  const formVerification = document.querySelector(".form-verification");
  formVerification.classList.add("d-none");
}

// password
const formVal = document.forms["form-change"];
var password1 = document.getElementById("password2");
var password2 = document.getElementById("password3");
// container
var confirmPassword = document.getElementById("confirm-password");

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

if (password1.value == "") {
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
  var loadingBtn = document.querySelector(".fa-spin-change");
  if (subValP1 == "1" || subValP2 == "1") {
    e.preventDefault();
    return;
  }
  loadingBtn.classList.remove("d-none");
});

// function startTimer(duration, display) {
//   var timer = duration,
//     minutes,
//     seconds;
//   setInterval(function () {
//     minutes = parseInt(timer / 60, 10);
//     seconds = parseInt(timer % 60, 10);

//     minutes = minutes < 10 ? "0" + minutes : minutes;
//     seconds = seconds < 10 ? "0" + seconds : seconds;

//     display.textContent = minutes + ":" + seconds;

//     if (--timer < 0) {
//       timer = duration;
//     }
//   }, 1000);
// }

// window.onload = function () {
//   var fiveMinutes = 60 * 2,
//     display = document.querySelector("#time");
//   startTimer(fiveMinutes, display);
// };
