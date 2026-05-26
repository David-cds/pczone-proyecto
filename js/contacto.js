document.addEventListener("DOMContentLoaded", function(){

    // Obtener el formulario por su id
    let formulario = document.getElementById("formContacto");


    // Evento submit del formulario
    formulario.addEventListener("submit", function(e){

        // Evita que se recargue la página
        e.preventDefault();

        // Obtener los valores introducidos por el usuario
        let nombre = document.getElementById("nombre").value;
        let correo = document.getElementById("correo").value;
        let mensaje = document.getElementById("mensaje").value;


        // Crear un nuevo div para almacenar el mensaje
        let contenedor = document.getElementById("resultado");

        // Crear un nuevo div para almacenar el mensaje
        let caja = document.createElement("div");

        // Crear párrafos para los datos introducidos
        let pNombre = document.createElement("p");
        pNombre.textContent = "Nombre: " + nombre;

        
        let pCorreo = document.createElement("p");
        pCorreo.textContent = "Correo: " + correo;

        
        let pMensaje = document.createElement("p");
        pMensaje.textContent = "Mensaje: " + mensaje;

        // Crear línea separadora
        let linea = document.createElement("hr");

        // Añadir elementos al div
        caja.appendChild(pNombre);
        caja.appendChild(pCorreo);
        caja.appendChild(pMensaje);
        caja.appendChild(linea);

        // Añadir el div al contenedor principal
        contenedor.appendChild(caja);

        // Limpiar formulario
        formulario.reset();

    });

});