const scriptURL =
  "http://localhost/TrifthinQs./assets/php/functions_wishlist.php";
const form = document.forms["form-wish"];

const love1 = document.querySelector(".love1");
const love2 = document.querySelector(".love2");
const notifWish = document.querySelector("#notif-wish");

form.addEventListener("submit", (e) => {
  e.preventDefault();

  fetch(scriptURL, {
    method: "POST",
    body: new FormData(form),
  })
    .then((response) => {
      love1.classList.toggle("d-none");
      love2.classList.toggle("d-none");

      // rest form
      form.reset();
      console.log("Success!", response);

      // buat object ajax
      var xhr = new XMLHttpRequest();

      // cek kesiapan ajax
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          notifWish.innerHTML = xhr.responseText;
        }
      };

      // eksekusi ajax
      xhr.open("GET", "assets/ajax/notifwish.php", true);
      xhr.send();
    })
    .catch((error) => {
      // rest form
      form.reset();
      console.error("Error!", error.message);
    });
});

function addCart(id) {
  const scriptURL = "http://localhost/TrifthinQs./product.php";
  const cart1 = document.querySelector(".cart1");
  const cart2 = document.querySelector(".cart2");
  const notifCart = document.querySelector("#notif-cart");

  fetch(scriptURL, {
    method: "POST",
    body: new URLSearchParams("addCart&id=" + id),
  })
    .then((response) => {
      cart1.classList.toggle("d-none");
      cart2.classList.toggle("d-none");

      // buat object ajax
      var xhr = new XMLHttpRequest();

      // cek kesiapan ajax
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          notifCart.innerHTML = xhr.responseText;
        }
      };

      // eksekusi ajax
      xhr.open("GET", "assets/ajax/notifcart.php", true);
      xhr.send();

      console.log("Success!", response);
    })
    .catch((error) => {
      console.error("Error!", error.message);
    });
}

function removeCart(id) {
  const scriptURL = "http://localhost/TrifthinQs./product.php";
  const cart1 = document.querySelector(".cart1");
  const cart2 = document.querySelector(".cart2");
  const notifCart = document.querySelector("#notif-cart");

  fetch(scriptURL, {
    method: "POST",
    body: new URLSearchParams("removeCart&id=" + id),
  })
    .then((response) => {
      cart1.classList.toggle("d-none");
      cart2.classList.toggle("d-none");

      // buat object ajax
      var xhr = new XMLHttpRequest();

      // cek kesiapan ajax
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          notifCart.innerHTML = xhr.responseText;
        }
      };

      // eksekusi ajax
      xhr.open("GET", "assets/ajax/notifcart.php", true);
      xhr.send();

      console.log("Success!", response);
    })
    .catch((error) => {
      console.error("Error!", error.message);
    });
}
