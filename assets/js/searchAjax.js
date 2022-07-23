// ambil elemen2 yang dibutuhkan
var search = document.getElementById("search");
var container = document.getElementById("container");
var showProdukSearch = document.getElementById("shop-search");
var showProduk = document.getElementById("shop");
var loadMore = document.getElementById("loadMore");
var slide = document.getElementById("slideshow");
var map = document.getElementById("map");

if (search.value != "") {
  slide.setAttribute("style", "display:none;");
  map.setAttribute("style", "display:none;");
  showProduk.setAttribute("style", "display:none;");
  showProdukSearch.setAttribute("style", "display:block;");
}

// tambahkan event ketika keyboard ditulis

search.addEventListener("keyup", function () {
  slide.setAttribute("style", "display:none;");
  map.setAttribute("style", "display:none;");
  container.setAttribute("style", "display:block;");
  showProduk.setAttribute("style", "display:none;");
  showProdukSearch.setAttribute("style", "display:none;");

  // buat object ajax
  var xhr = new XMLHttpRequest();

  // cek kesiapan ajax
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      container.innerHTML = xhr.responseText;
    }
  };

  // eksekusi ajax
  xhr.open("GET", "assets/ajax/search.php?search=" + search.value, true);
  xhr.send();

  if (search.value == "") {
    slide.setAttribute("style", "display:;");
    map.setAttribute("style", "display:;");
    showProduk.setAttribute("style", "display:block;");

    // eksekusi ajax
    xhr.open("GET", "assets/ajax/searchNormal.php", true);
    xhr.send();
  }
});
