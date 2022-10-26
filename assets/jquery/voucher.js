$(function () {
  $(".voucher").bind("submit", function () {
    $.ajax({
      type: "GET",
      url: "assets/ajax/cart.php",
      data: $(".voucher").serialize(),
      success: function () {
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
          "assets/ajax/cart.php?voucher=" + $(".voucher").value,
          true
        );
        xhr.send();
      },
    });
    return false;
  });
});
