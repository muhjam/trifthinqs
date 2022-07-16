// ambil elemen2 yang dibutuhkan
var email = document.getElementById("email");
var username = document.getElementById("username");
var password1 = document.getElementById("exampleDropdownFormPassword1");
var password2 = document.getElementById("exampleDropdownFormPassword2");
var confirm = document.getElementById("confirm");
var password = document.getElementById("password");

// container
var colEmail = document.getElementById("colEmail");
var colName = document.getElementById("colName");
var colPassword1 = document.getElementById("colPassword1");
var colPassword2 = document.getElementById("colPassword2");

// tambahkan event ketika keyboard ditulis
email.addEventListener("keyup", function(event) {
    // buat object ajax
    var xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            colEmail.innerHTML = xhr.responseText;
        }
    };

    // eksekusi ajax
    xhr.open("GET", "assets/ajax/signup.php?email=" + email.value, true);
    xhr.send();
});

// ketika backslash ditekan
email.addEventListener("keypress", (e) => {
    if (e.code == "Backslash") {
        e.preventDefault();
    }

    if (e.code == "Quote") {
        e.preventDefault();
    }
});

// tambahkan event ketika keyboard ditulis
username.addEventListener("keyup", function() {
    // buat object ajax
    var xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            colName.innerHTML = xhr.responseText;
        }
    };

    // eksekusi ajax
    xhr.open("GET", "assets/ajax/signup.php?username=" + username.value, true);
    xhr.send();
});

// tambahkan event ketika keyboard ditulis
password1.addEventListener("keyup", function() {
    // buat object ajax
    var xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            colPassword1.innerHTML = xhr.responseText;
        }
    };

    // eksekusi ajax
    xhr.open("GET", "assets/ajax/signup.php?password1=" + password1.value, true);
    xhr.send();
});

// tambahkan event ketika keyboard ditulis
password2.addEventListener("keyup", function() {
    // buat object ajax
    var xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            colPassword2.innerHTML = xhr.responseText;
        }
    };

    // tambahkan event ketika keyboard ditulis
    password1.addEventListener("keyup", function() {
        // eksekusi ajax
        xhr.open(
            "GET",
            "assets/ajax/signup.php?password1=" +
            password1.value +
            "&password2=" +
            password2.value,
            true
        );
        xhr.send();
    });

    // eksekusi ajax
    xhr.open(
        "GET",
        "assets/ajax/signup.php?password1=" +
        password1.value +
        "&password2=" +
        password2.value,
        true
    );
    xhr.send();
});

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