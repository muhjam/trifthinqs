// ambil elemen2 yang dibutuhkan
var search = document.getElementById("search");
var livesearch = document.getElementById("livesearch");
var formSearch = document.getElementById("form-search");

if (search.value == "") {
  document.getElementById("livesearch").innerHTML = "";
  document.getElementById("livesearch").style.display = "none";
}

search.addEventListener("input", function () {
  if (search.value == "") {
    document.getElementById("livesearch").innerHTML = "";
    document.getElementById("livesearch").style.display = "none";
    return;
  }
  search.setAttribute("value", search.value);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("livesearch").innerHTML = this.responseText;
      document.getElementById("livesearch").style.display = "block";
    }
  };
  xmlhttp.open("GET", "assets/ajax/livesearch.php?q=" + search.value, true);
  xmlhttp.send();
});

search.addEventListener("focus", function () {
  if (search.value == "") {
    document.getElementById("livesearch").innerHTML = "";
    document.getElementById("livesearch").style.display = "none";
  } else {
    search.setAttribute("value", search.value);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("livesearch").innerHTML = this.responseText;
        document.getElementById("livesearch").style.display = "block";
      }
    };
    xmlhttp.open("GET", "assets/ajax/livesearch.php?q=" + search.value, true);
    xmlhttp.send();
  }
});

search.addEventListener("focusout", function () {
  document.getElementById("livesearch").style.display = "none";
});

formSearch.addEventListener("submit", function (e) {
  if (search.value == "") {
    e.preventDefault();
  }
});
