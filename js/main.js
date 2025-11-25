// main.js - behaviors (minimal)
// Currently only ensures nav hover is handled by CSS; we can add JS hooks later if needed.
console.log('Genus Gaming JS loaded');

let slideIndex = 0;
showSlide();

function showSlide() {
    const slides = document.querySelectorAll(".banner-slide");
    if (slides.length === 0) return;

    slides.forEach(slide => slide.style.display = "none");

    slideIndex++;
    if (slideIndex > slides.length) slideIndex = 1;

    slides[slideIndex - 1].style.display = "block";

    setTimeout(showSlide, 3000); // mỗi 3 giây chuyển slide
}

