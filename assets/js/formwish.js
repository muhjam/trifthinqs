const scriptURLw =
    "http://localhost/GoturthinQs/assets/php/functions_wishlist.php";
const formw = document.forms["form-wish"];

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
            xhr.onreadystatechange = function() {
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

const scriptURLc = "http://localhost/GoturthinQs/assets/php/functions_cart.php";
const formc = document.forms["form-cart"];

const notifCart = document.querySelector("#notif-cart");
const id_uc = document.querySelector("#id_uc");

formc.addEventListener("submit", (e) => {
    e.preventDefault();

    fetch(scriptURLc, {
            method: "POST",
            body: new FormData(formc),
        })
        .then((response) => {
            cart1.classList.toggle("d-none");
            cart2.classList.toggle("d-none");

            // rest form
            formc.reset();
            console.log("Success!", response);

            // buat object ajax
            var xhr = new XMLHttpRequest();

            // cek kesiapan ajax
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    notifCart.innerHTML = xhr.responseText;
                }
            };

            // eksekusi ajax
            xhr.open("GET", "assets/ajax/notifcart.php?id_u=" + id_uc.value, true);
            xhr.send();
        })
        .catch((error) => {
            // rest form
            formw.reset();
            console.error("Error!", error.message);
        });
});