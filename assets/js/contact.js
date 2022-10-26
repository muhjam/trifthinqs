const scriptURL = "http://localhost/TrifthinQs./assets/php/send.php";
const form = document.forms["Trifthinqs-contact-form"];

const btnKirim = document.querySelector(".btn-kirim");
const btnLoading = document.querySelector(".btn-loading");
const alertSuccess = document.querySelector(".alert-success");
const alertFailed = document.querySelector(".alert-failed");
const cancel = document.querySelector(".cancel");

form.addEventListener("submit", (e) => {
  e.preventDefault();

  // ketika tombol loading di klik
  // tampilkan tombol loading hilangkan tombol kirim
  btnLoading.classList.remove("d-none");
  btnKirim.classList.add("d-none");

  fetch(scriptURL, {
    method: "POST",
    body: new FormData(form),
  })
    .then((response) => {
      // tampilkan tombol kirim, tampilkan tombol loading
      btnLoading.classList.add("d-none");
      btnKirim.classList.remove("d-none");

      // alert success
      alertSuccess.classList.remove("d-none");

      // rest form
      form.reset();
      console.log("Success!", response);
    })
    .catch((error) => {
      // tampilkan tombol kirim, tampilkan tombol loading
      btnLoading.classList.add("d-none");
      btnKirim.classList.remove("d-none");

      // alert failed
      alertFailed.classList.remove("d-none");

      // rest form
      form.reset();

      console.error("Error!", error.message);
    });
});

const close = document.querySelector(".close");

close.addEventListener("click", function () {
  // alert success
  alertSuccess.classList.add("d-none");

  // alert failed
  alertFailed.classList.add("d-none");
});

function inputKeyup(id) {
  cancel.classList.remove("d-none");
}
