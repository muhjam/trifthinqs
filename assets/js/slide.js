var slideIndex = 1;
var timer = null;
showSlides(slideIndex);

function plusSlides(n) {
  clearTimeout(timer);
  showSlides((slideIndex += n));
}

function currentSlide(n) {
  clearTimeout(timer);
  showSlides((slideIndex = n));
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n == undefined) {
    n = ++slideIndex;
  }
  if (n > slides.length) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slides.length;
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex - 1].style.display = "block";
  timer = setTimeout(showSlides, 5000);
}

// ketika search sudah di enter, hilangkan slide show
if (search.value != "") {
  var slide = document.getElementById("slideshow");
  slide.setAttribute("style", "display:none;");
}
