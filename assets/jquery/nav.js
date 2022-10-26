$(function () {
  // mencegah form search reload
  $("#form-search").submit(function () {
    event.preventDefault();
  });
});
