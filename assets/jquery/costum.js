$(function () {
  // mencegah form search reload
  $("#form-search").submit(function () {
    event.preventDefault();
  });

  // loadmore
  $(".news-items").slice(0, 8).show();

  $(".load-more").on("click", function () {
    $(".news-items:hidden").slice(0, 8).slideDown();
    $(".heading").text("ALL ITEMS");
    if ($(".news-items:hidden").length == 0) {
      $(".loadMore").fadeOut("slow");
    }
  });

  if ($(".news-items:hidden").length == 0) {
    $(".loadMore").fadeOut("slow");
  }
});
