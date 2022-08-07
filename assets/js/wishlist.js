function addWish(id_u, id_w, btn) {
  const scriptURL =
    "http://localhost/TrifthinQs./assets/php/functions_wishlist.php";
  var love1 = document.getElementById(btn);
  var love2 = document.getElementById(parseInt(btn) + 1);

  fetch(scriptURL, {
    method: "POST",
    body: new URLSearchParams("id_w=" + id_w),
  })
    .then((response) => {
      love1.classList.add("d-none");
      love2.classList.remove("d-none");

      console.log("Success!", response);
    })
    .catch((error) => {
      console.error("Error!", error.message);
    });
}

function removeWish(id_u, id_w, btn) {
  const scriptURL =
    "http://localhost/TrifthinQs./assets/php/functions_wishlist.php";
  var love2 = document.getElementById(btn);
  var love1 = document.getElementById(btn - 1);

  fetch(scriptURL, {
    method: "POST",
    body: new URLSearchParams("id_w=" + id_w),
  })
    .then((response) => {
      love1.classList.remove("d-none");
      love2.classList.add("d-none");

      console.log("Success!", response);
    })
    .catch((error) => {
      console.error("Error!", error.message);
    });
}

function addCart(id, code, btn) {
  const scriptURL = "http://localhost/TrifthinQs./wishlist.php";
  const notifCart = document.querySelector("#notif-cart");
  var cart1 = document.getElementById(btn);
  var cart2 = document.getElementById(parseInt(btn) + 1);

  fetch(scriptURL, {
    method: "POST",
    body: new URLSearchParams("addCart&id_c=" + id + "&code_c=" + code),
  })
    .then((response) => {
      cart1.classList.add("d-none");
      cart2.classList.remove("d-none");
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

function removeCart(id, code, btn) {
  const scriptURL = "http://localhost/TrifthinQs./wishlist.php";
  var cart2 = document.getElementById(btn);
  var cart1 = document.getElementById(btn - 1);
  const notifCart = document.querySelector("#notif-cart");

  fetch(scriptURL, {
    method: "POST",
    body: new URLSearchParams("removeCart&id_c=" + id + "&code_c=" + code),
  })
    .then((response) => {
      cart1.classList.remove("d-none");
      cart2.classList.add("d-none");

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
