// login function
// login validation
function usernameV() {
  var val = document.getElementById("valN");
  if (username.value == "") {
    red("valN", "username", "iName1", "iName2");
    val.innerHTML = "Please enter your name";
    return (subValN = "1");
  } else if (
    username.value.length <= 1 ||
    /^[a-z A-Z]+$/.test(username.value) == false
  ) {
    red("valN", "username", "iName1", "iName2");
    val.innerHTML = "*Only character";
    return (subValN = "1");
  } else {
    green("valN", "username", "iName1", "iName2");
    val.innerHTML = "";
    return (subValN = "0");
  }
}

function emailV() {
  var container = document.getElementById("styleLogin");
  var val = document.getElementById("valE");
  let result = email.value.substring(email.value.length - 10);
  let count = (email.value.match(/@/g) || []).length;

  if (email.value == "") {
    red("valE", "email2", "iEmail1", "iEmail2");
    val.innerHTML = "Please enter your email";
    container.innerHTML = "";
    return (subValE = "1");
  } else if (
    result != "@gmail.com" ||
    count != "1" ||
    email.value.length <= 10 ||
    /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value) == false
  ) {
    red("valE", "email2", "iEmail1", "iEmail2");
    val.innerHTML = "*Use @gmail.com";
    container.innerHTML = "";
    return (subValE = "1");
  }
  red("valE", "email2", "iEmail1", "iEmail2");
  val.innerHTML = "This account already exists";
  // buat object ajax
  var xhr = new XMLHttpRequest();
  // cek kesiapan ajax
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      container.innerHTML = xhr.responseText;
    }
  };
  // eksekusi ajax
  xhr.open("GET", "assets/ajax/signup.php?email=" + email.value, true);
  xhr.send();
  return (subValE = "0");
}

function password1V() {
  var val = document.getElementById("valP1");
  if (password1.value.length == 0) {
    red("valP1", "password2", "iPass1", "iPass2");
    val.innerHTML = "Please creat your password";
    confirmPassword.setAttribute("style", "display:none;");
    return (subValP1 = "1");
  } else if (password1.value.length <= 8) {
    red("valP1", "password2", "iPass1", "iPass2");
    val.innerHTML = "*Min-length 8";
    confirmPassword.setAttribute("style", "display:none;");
    return (subValP1 = "1");
  }
  passwordCV();
  green("valP1", "password2", "iPass1", "iPass2");
  val.innerHTML = "";
  confirmPassword.setAttribute("style", "display:block;");
  return (subValP1 = "0");
}

function password2V() {
  var val = document.getElementById("valP2");
  if (password2.value.length == 0) {
    red("valP2", "password3", "iPassC1", "iPassC2");
    val.innerHTML = "Please confirm your password";
    confirmPassword.setAttribute("style", "display:block;");
    return (subValP2 = "1");
  } else if (password2.value !== password1.value) {
    red("valP2", "password3", "iPassC1", "iPassC2");
    val.innerHTML = "Confirm password doesn't match";
    confirmPassword.setAttribute("style", "display:block;");
    return (subValP2 = "1");
  } else if (password2.value === password1.value) {
    green("valP2", "password3", "iPassC1", "iPassC2");
    val.innerHTML = "";
    confirmPassword.setAttribute("style", "display:block;");
    return (subValP2 = "0");
  }
}

function passwordCV() {
  var val = document.getElementById("valP2");
  if (password2.value.length == 0) {
    return (subValP2 = "1");
  } else if (password2.value !== password1.value) {
    red("valP2", "password3", "iPassC1", "iPassC2");
    val.innerHTML = "Confirm password doesn't match";
    confirmPassword.setAttribute("style", "display:block;");
    return (subValP2 = "1");
  } else if (password2.value === password1.value) {
    green("valP2", "password3", "iPassC1", "iPassC2");
    val.innerHTML = "";
    confirmPassword.setAttribute("style", "display:block;");
    return (subValP2 = "0");
  }
}

function red(a, b, c, d) {
  var val = document.getElementById(a);
  var text = document.getElementById(b);
  var i1 = document.getElementById(c);
  var i2 = document.getElementById(d);
  val.setAttribute("style", "display:block;");
  text.setAttribute("style", "border:1px solid red;");
  i1.classList.remove("d-none");
  i2.classList.add("d-none");
}

function green(a, b, c, d) {
  var val = document.getElementById(a);
  var text = document.getElementById(b);
  var i1 = document.getElementById(c);
  var i2 = document.getElementById(d);
  val.setAttribute("style", "display:none;");
  text.setAttribute("style", "border:1px solid green;");
  i1.classList.add("d-none");
  i2.classList.remove("d-none");
}

// functions form login
// show password
function showPassword() {
  var x = document.querySelector(".showPassword1");
  var z = document.querySelector(".showPassword");
  if (x.type === "password") {
    z.classList.add("fa-eye");
    z.classList.remove("fa-eye-slash");
    x.type = "text";
    check();
  } else {
    z.classList.remove("fa-eye");
    z.classList.add("fa-eye-slash");
    x.type = "password";
    uncheck();
  }
}

// function showPassword2() {
//   var y = document.querySelector(".showPassword2");
//   if (document.querySelector(".showPassword3") === false) {
//     if (y.type === "password") {
//       y.type = "text";
//       check();
//     } else {
//       y.type = "password";
//       uncheck();
//     }
//   } else {
//     var z = document.querySelector(".showPassword3");
//     if (y.type === "password") {
//       y.type = "text";
//       z.type = "text";
//       check();
//     } else {
//       y.type = "password";
//       z.type = "password";
//       uncheck();
//     }
//   }
// }

// // tambahkan event ketika keyboard ditulis
// password2.addEventListener("keyup", function () {
//   if (password1.type === "password") {
//     password2.type = "password";
//   } else {
//     password2.type = "text";
//   }
// });

// cehcked
function check() {
  document.querySelector(".showPassword").checked = true;
}

function uncheck() {
  document.querySelector(".showPassword").checked = false;
}

// function login
function login() {
  var x = document.querySelector(".showPassword1");
  var y = document.querySelector(".showPassword2");
  var z = document.querySelector(".showPassword");
  x.type = "password";
  y.type = "password";
  z.classList.remove("fa-eye");
  z.classList.add("fa-eye-slash");
  const formLogin = document.querySelector(".form-login");
  formLogin.classList.remove("d-none");
  const formSignup = document.querySelector(".form-signup");
  formSignup.classList.add("d-none");
  const formForgot = document.querySelector(".form-forgot");
  formForgot.classList.add("d-none");
  document.querySelector(".showPassword").checked = false;
}
// function signup
function signup() {
  var x = document.querySelector(".showPassword1");
  var y = document.querySelector(".showPassword2");
  var z = document.querySelector(".showPassword");
  x.type = "password";
  y.type = "password";
  z.classList.remove("fa-eye");
  z.classList.add("fa-eye-slash");
  const formLogin = document.querySelector(".form-login");
  formLogin.classList.add("d-none");
  const formSignup = document.querySelector(".form-signup");
  formSignup.classList.remove("d-none");
  const formForgot = document.querySelector(".form-forgot");
  formForgot.classList.add("d-none");
  document.querySelector(".showPassword").checked = false;
}

// function forgot password
function forgot() {
  var x = document.querySelector(".showPassword1");
  var y = document.querySelector(".showPassword2");
  var z = document.querySelector(".showPassword");
  x.type = "password";
  y.type = "password";
  z.classList.remove("fa-eye");
  z.classList.add("fa-eye-slash");
  const formLogin = document.querySelector(".form-login");
  formLogin.classList.add("d-none");
  const formSignup = document.querySelector(".form-signup");
  formSignup.classList.add("d-none");
  const formForgot = document.querySelector(".form-forgot");
  formForgot.classList.remove("d-none");
  document.querySelector(".showPassword").checked = false;
}

function closeForm() {
  var x = document.querySelector(".showPassword1");
  var y = document.querySelector(".showPassword2");
  var z = document.querySelector(".showPassword");
  x.type = "password";
  y.type = "password";
  z.classList.remove("fa-eye");
  z.classList.add("fa-eye-slash");
  const formLogin = document.querySelector(".form-login");
  formLogin.classList.add("d-none");
  const formSignup = document.querySelector(".form-signup");
  formSignup.classList.add("d-none");
  const formForgot = document.querySelector(".form-forgot");
  formForgot.classList.add("d-none");
  document.querySelector(".showPassword").checked = false;
}

function loadingBtn(loadingBtn) {
  var loadingBtn = document.querySelector(loadingBtn);
  loadingBtn.classList.remove("d-none");
}
// tambahkan event ketika keyboard ditulis
// const formSignup = document.forms["form-signup"];
// formSignup.addEventListener("submit", (e) => {
//   e.preventDefault();
//   const scriptURL = "http://localhost/TrifthinQs./assets/login/login.php";
//   fetch(scriptURL, {
//     method: "POST",
//     body: new FormData(formSignup),
//   });
// });

// change password
function inputPassOld() {
  var container = document.getElementById("containChangePass");
  var val = document.getElementById("valPOld");
  if (passwordOld.value.length == 0) {
    red("valPOld", "passwordOld", "iPassOld1", "iPassOld2");
    val.innerHTML = "Please input your password";
    container.innerHTML = "";
    return (subValPOld = "1");
  }
  val.innerHTML = "Incorrect password";
  // buat object ajax
  var xhr = new XMLHttpRequest();
  // cek kesiapan ajax
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      container.innerHTML = xhr.responseText;
    }
  };
  // eksekusi ajax
  xhr.open(
    "GET",
    "assets/ajax/oldpassword.php?password=" + passwordOld.value,
    true
  );
  xhr.send();
  return (subValPOld = "0");
}

function inputPassword1() {
  var val = document.getElementById("valP1");
  if (passwordOld.value == password1.value) {
    red("valP1", "password2", "iPass1", "iPass2");
    val.innerHTML = "New password cannot be the same as the old password";
    subValP1 = "1";
    passwordConfirm();
    return;
  } else if (password1.value.length == 0) {
    red("valP1", "password2", "iPass1", "iPass2");
    val.innerHTML = "Please creat your password";
    confirmPassword.setAttribute("style", "display:none;");
    passwordConfirm();
    return (subValP1 = "1");
  } else if (password1.value.length < 8) {
    red("valP1", "password2", "iPass1", "iPass2");
    val.innerHTML = "*Min-length 8";
    confirmPassword.setAttribute("style", "display:none;");
    passwordConfirm();
    return (subValP1 = "1");
  }
  passwordConfirm();
  green("valP1", "password2", "iPass1", "iPass2");
  val.innerHTML = "";
  confirmPassword.setAttribute("style", "display:block;");
  return (subValP1 = "0");
}

function inputPassword2() {
  var val = document.getElementById("valP2");
  if (passwordOld.value == password1.value) {
    red("valP2", "password3", "iPassC1", "iPassC2");
    val.innerHTML = "Please fix the new password";
    subValP2 = "1";
    return;
  } else if (password2.value.length == 0) {
    red("valP2", "password3", "iPassC1", "iPassC2");
    val.innerHTML = "Please confirm your password";
    confirmPassword.setAttribute("style", "display:block;");
    return (subValP2 = "1");
  } else if (
    password2.value !== password1.value ||
    password1.value.length < 8
  ) {
    red("valP2", "password3", "iPassC1", "iPassC2");
    val.innerHTML = "Confirm password doesn't match";
    confirmPassword.setAttribute("style", "display:block;");
    return (subValP2 = "1");
  } else if (
    password2.value === password1.value &&
    password1.value.length >= 8
  ) {
    green("valP2", "password3", "iPassC1", "iPassC2");
    val.innerHTML = "";
    confirmPassword.setAttribute("style", "display:block;");
    return (subValP2 = "0");
  }
}

function passwordConfirm() {
  var val = document.getElementById("valP2");
  if (passwordOld.value == password1.value) {
    red("valP2", "password3", "iPassC1", "iPassC2");
    val.innerHTML = "Please fix the new password";
    subValP2 = "1";
    return;
  } else if (password2.value.length == 0) {
    return (subValP2 = "1");
  } else if (
    password2.value !== password1.value ||
    password1.value.length < 8
  ) {
    red("valP2", "password3", "iPassC1", "iPassC2");
    val.innerHTML = "Confirm password doesn't match";
    confirmPassword.setAttribute("style", "display:block;");
    return (subValP2 = "1");
  } else if (
    password2.value === password1.value &&
    password1.value.length >= 8
  ) {
    green("valP2", "password3", "iPassC1", "iPassC2");
    val.innerHTML = "";
    confirmPassword.setAttribute("style", "display:block;");
    return (subValP2 = "0");
  }
}
