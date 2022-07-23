const scriptURLw =
  "http://localhost/GoturthinQs/assets/php/functions_wishlist.php";
const formw = document.forms["form-wish"];

const love1 = document.querySelector(".love1");
const love2 = document.querySelector(".love2");
const notifWish = document.querySelector("#notif-wish");
const id_uw = document.querySelector("#id_uw");

formw.addEventListener("submit", (e) => {
  e.preventDefault();

  fetch(scriptURLw, {
    method: "POST",
    body: new FormData(formw),
  })
    .then((response) => {
      love1.classList.toggle("d-none");
      love2.classList.toggle("d-none");

      // rest form
      formw.reset();
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
      xhr.open("GET", "assets/ajax/notifwish.php?id_u=" + id_uw.value, true);
      xhr.send();
    })
    .catch((error) => {
      // rest form
      formw.reset();
      console.error("Error!", error.message);
    });
});

function addCart(code_c, id_c) {
  const scriptURL = "http://localhost/GoturthinQs/product.php";
  const cart1 = document.querySelector(".cart1");
  const cart2 = document.querySelector(".cart2");
  const notifCart = document.querySelector("#notif-cart");

  fetch(scriptURL, {
    method: "POST",
    body: new URLSearchParams("code_c=" + code_c + "&id_c=" + id_c),
  })
    .then((response) => {
      cart1.classList.toggle("d-none");
      cart2.classList.toggle("d-none");

      //   // buat object ajax
      //   var xhr = new XMLHttpRequest();

      //   // cek kesiapan ajax
      //   xhr.onreadystatechange = function () {
      //     if (xhr.readyState == 4 && xhr.status == 200) {
      //       notifCart.innerHTML = xhr.responseText;
      //     }
      //   };

      //   // eksekusi ajax
      //   xhr.open("GET", "assets/ajax/notifcart.php?id_c=" + id_c, true);
      //   xhr.send();

      console.log("Success!", response);
    })
    .catch((error) => {
      console.error("Error!", error.message);
    });
}
