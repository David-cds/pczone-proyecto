// SLIDESHOW

let index = 0;

function slider(){

    let slides = document.querySelectorAll(".slide");

    if(slides.length === 0) return;

    slides.forEach(s => s.style.display = "none");

    slides[index].style.display = "block";

    index++;
    if(index >= slides.length) index = 0;
}

setInterval(slider, 3000);