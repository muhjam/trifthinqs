const scriptURLw =
    "http://localhost/GoturthinQs/assets/php/functions_wishlist.php";
const formw = document.forms["form-wish"];

const id_uw = document.querySelector("#id_uw");
const container = document.querySelector(".container");

formw.addEventListener("submit", (e) => {
    e.preventDefault();

    fetch(scriptURLw, {
            method: "POST",
            body: new FormData(formw),
        })
        .then((response) => {
            // rest form
            formw.reset();
            console.log("Success!", response);

            // buat object ajax
            var xhr = new XMLHttpRequest();

            // cek kesiapan ajax
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    container.innerHTML = xhr.responseText;
                }
            };

            // eksekusi ajax
            xhr.open(
                "GET",
                "assets/ajax/wishlistTable.php?id_u=" + id_uw.value,
                true
            );
            xhr.send();
        })
        .catch((error) => {
            // rest form
            formw.reset();
            console.error("Error!", error.message);
        });
});