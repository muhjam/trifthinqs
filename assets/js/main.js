if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

// function wellcome(username) {
//   const Toast = Swal.mixin({
//     toast: true,
//     position: "top-end",
//     showConfirmButton: false,
//     timer: 3000,
//     timerProgressBar: true,
//     didOpen: (toast) => {
//       toast.addEventListener("mouseenter", Swal.stopTimer);
//       toast.addEventListener("mouseleave", Swal.resumeTimer);
//     },
//   });

//   Toast.fire({
//     icon: "success",
//     title: "Wellcome," + username,
//   });
// }
