function removeCart(code_c) {
  const scriptURL = "http://localhost/TrifthinQs./cart.php";
  const container = document.querySelector("#container");

  fetch(scriptURL, {
    method: "POST",
    body: new URLSearchParams("removeCart&code_c=" + code_c),
  })
    .then((response) => {
      // buat object ajax
      var xhr = new XMLHttpRequest();

      // cek kesiapan ajax
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          container.innerHTML = xhr.responseText;
        }
      };

      // eksekusi ajax
      xhr.open("GET", "assets/ajax/cart.php?code_c=" + code_c, true);
      xhr.send();

      console.log("Success!", response);
    })
    .catch((error) => {
      console.error("Error!", error.message);
    });
}

function clearCart() {
  const scriptURL = "http://localhost/TrifthinQs./cart.php";
  const container = document.querySelector("#container");
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, clear cart!",
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(scriptURL, {
        method: "POST",
        body: new URLSearchParams("clearCart"),
      }).then((response) => {
        Swal.fire("Cleaned!", "Your cart has been cleaned.", "success");
        // buat object ajax
        var xhr = new XMLHttpRequest();

        // cek kesiapan ajax
        xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
            container.innerHTML = xhr.responseText;
          }
        };
        // eksekusi ajax
        xhr.open("GET", "assets/ajax/cart.php?cleanCart", true);
        xhr.send();
      });
    }
  });
}

function undo() {
  const scriptURL = "http://localhost/TrifthinQs./cart.php";
  const container = document.querySelector("#container");
  fetch(scriptURL, {
    method: "POST",
    body: new URLSearchParams("undoCart"),
  })
    .then((response) => {
      // buat object ajax
      var xhr = new XMLHttpRequest();

      // cek kesiapan ajax
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          container.innerHTML = xhr.responseText;
        }
      };

      // eksekusi ajax
      xhr.open("GET", "assets/ajax/cart.php?undoCart", true);
      xhr.send();

      console.log("Success!", response);
    })
    .catch((error) => {
      console.error("Error!", error.message);
    });
}

function close_alert(x) {
  const y = document.querySelector(x);
  y.classList.add("d-none");
}

var formVoucher = document.querySelector("form[name='form-voucher']");

formVoucher.addEventListener("submit", function (e) {
  var voucher = document.querySelector(
    "form[name='form-voucher'] input[name='voucher']"
  );
  if (voucher.value.length != "10") {
    e.preventDefault();
    return;
  }
});
