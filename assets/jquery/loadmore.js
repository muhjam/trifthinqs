$(function () {
  // loadmore
  $(".news-items").slice(0, 8).show();

  $(".load-more").on("click", function () {
    $(".news-items:hidden").slice(0, 8).slideDown();
    $(".fist-heading").text("ALL ITEMS");
    if ($(".news-items:hidden").length == 0) {
      $(".loadMore").fadeOut("slow");
    }
  });

  if ($(".news-items:hidden").length == 0) {
    $(".loadMore").fadeOut("slow");
  }
  // $("#form-search").submit((e) => {
  //   if (formInput.val() === "") {
  //     $(formErrorMsg).text("Input field can't be empty.");
  //     return false;
  //   }

  //   return true;
  // });
});

// search autofocus
// if (document.getElementById("search").value.length != 0) {
//   $(function () {
//     var input = $("#txt1");
//     var len = input.val().length;
//     input[0].focus();
//     input[0].setSelectionRange(len, len);
//   });
//   $(document).ready(function () {
//     $("#search").focus(function () {
//       if (this.setSelectionRange) {
//         var len = $(this).val().length;
//         this.setSelectionRange(len, len);
//       } else {
//         $(this).val($(this).val());
//       }
//     });

//     $("#search").focus();
//   });
// }
