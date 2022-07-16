const scriptURL =
    "http://localhost/GoturthinQs/assets/php/functions_wishlist.php";
const form = document.forms["form-wish"];

form.addEventListener("submit", (e) => {
    e.preventDefault();

    fetch(scriptURL, {
            method: "POST",
            body: new FormData(form),
        })
        .then((response) => {
            // rest form
            form.reset();
            console.log("Success!", response);
        })
        .catch((error) => {
            // rest form
            form.reset();
            console.error("Error!", error.message);
        });
});