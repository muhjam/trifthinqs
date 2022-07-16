$(function() {
    // mencegah form search reload
    $("form").submit(function() {
        event.preventDefault();
    });

    // loadmore
    $(".news-items").slice(0, 4).show();

    $(".load-more").on("click", function() {
        $(".news-items:hidden").slice(0, 4).slideDown();
        $(".heading").text("ALL ITEMS");
        if ($(".news-items:hidden").length == 0) {
            $(".loadMore").fadeOut("slow");
        }
    });

    if ($(".news-items:hidden").length == 0) {
        $(".loadMore").fadeOut("slow");
    }
});