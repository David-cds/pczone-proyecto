// UI GENERAL (DATE + EFECTOS + DOM)

document.addEventListener("DOMContentLoaded", function(){

    // Obtener dia,mes y año actuales
    let fecha = new Date();
    let f = document.getElementById("fecha");

    if(f){
        f.innerHTML = "Hoy es: " + fecha.toLocaleDateString();
    }

});

// JQUERY
$(document).ready(function(){

    // Mostrar / ocultar productos
    $("#toggleProductos").click(function(){
        $(".productos").slideToggle();
    });

    // Hover en las tarjetas al poner raton sobre ellas
    $(".card").hover(
        function(){ $(this).fadeTo(200, 0.7); },
        function(){ $(this).fadeTo(200, 1); }
    );

});