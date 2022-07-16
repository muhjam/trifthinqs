// show password
function showPassword() {
    var x = document.getElementById("exampleDropdownFormPassword1");
    var y = document.getElementById("exampleDropdownFormPassword2");

    if (x.type === "password") {
        x.type = "text";
        y.type = "text";
        check();
    } else {
        x.type = "password";
        y.type = "password";
        uncheck();
    }
}

// cehcked
function check() {
    document.querySelector(".showpassword").checked = true;
}

function uncheck() {
    document.querySelector(".showpassword").checked = false;
}