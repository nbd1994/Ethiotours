// nav bar scroll effect starts here
function updateNavbar() {
  // Check if the current page is the home page
  const nav = document.querySelector("nav");
  if (
    window.location.pathname === "/" ||
    window.location.pathname === "/index.php"
  ) {
    if (window.scrollY > 100) {
      nav.classList.add("scrolled");
    } else {
      nav.classList.remove("scrolled");
    }
  }
  else{
    nav.classList.add("scrolled");
  }
}
document.addEventListener("DOMContentLoaded", updateNavbar);
window.onscroll=updateNavbar;
// nav bar scroll effect ends here

let slideIndex = 0;
let timer = null;
let slides = document.getElementsByClassName("mySlides");

function showSlides() {
  let i;
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }
  slides[slideIndex - 1].style.display = "block";
  // Clear the old timer and set a new one
  clearTimeout(timer);
  timer = setTimeout(showSlides, 5000); // Change image every 5 seconds
}

function plusSlides(n) {
  slideIndex += n;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  } else if (slideIndex < 1) {
    slideIndex = slides.length;
  }
  showSlides();
}
showSlides();
