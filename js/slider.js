// Índice para controlar la diapositiva actual
let index = 0;

function slider(){


    // Seleccionar todas las diapositivas del DOM
    let slides = document.querySelectorAll(".slide");

    // Si no hay diapositivas en la página, salir de la función
    if(slides.length === 0) return;


    // Ocultar todas las diapositivas
    slides.forEach(s => s.style.display = "none");


    // Mostrar solo la diapositiva actual
    slides[index].style.display = "block";


    // Pasar a la siguiente diapositiva e ir al inicio si llega al final
    index++;
    if(index >= slides.length) index = 0;
}

setInterval(slider, 3000);