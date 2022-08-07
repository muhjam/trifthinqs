function login() {
  const formVerification = document.querySelector(".form-verification");
  formVerification.classList.remove("d-none");
}

function closeForm() {
  const formVerification = document.querySelector(".form-verification");
  formVerification.classList.add("d-none");
}

function loadingBtn() {
  var loadingBtn = document.querySelector(".fa-circle-o-notch");
  const resendForm = document.querySelector(".resend-form");
  loadingBtn.classList.remove("d-none");
  resendForm.classList.add("d-none");
}
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
