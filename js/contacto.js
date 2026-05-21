document.addEventListener("DOMContentLoaded", function(){

    let formulario = document.getElementById("formContacto");

    formulario.addEventListener("submit", function(e){

        e.preventDefault();

        let nombre = document.getElementById("nombre").value;
        let correo = document.getElementById("correo").value;
        let mensaje = document.getElementById("mensaje").value;

        let contenedor = document.getElementById("resultado");

        // DIV DEL MENSAJE
        let caja = document.createElement("div");

        // NOMBRE
        let pNombre = document.createElement("p");
        pNombre.textContent = "Nombre: " + nombre;

        // CORREO
        let pCorreo = document.createElement("p");
        pCorreo.textContent = "Correo: " + correo;

        // MENSAJE
        let pMensaje = document.createElement("p");
        pMensaje.textContent = "Mensaje: " + mensaje;

        // LÍNEA
        let linea = document.createElement("hr");

        // AÑADIR AL DIV
        caja.appendChild(pNombre);
        caja.appendChild(pCorreo);
        caja.appendChild(pMensaje);
        caja.appendChild(linea);

        // AÑADIR AL CONTENEDOR
        contenedor.appendChild(caja);

        formulario.reset();

    });

});