// VALIDACIÓN DE FORMULARIOS

document.addEventListener("DOMContentLoaded", function(){

    // LOGIN
    const login = document.getElementById("formLogin");


    // Verificar si el formulario de login existe en la página actual
    if(login){
        login.addEventListener("submit", function(e){

            // Capturar y limpiar espacios en blanco de los inputs
            let email = document.querySelector("input[name='email']").value.trim();
            let pass = document.querySelector("input[name='password']").value.trim();

            let errores = [];

            // Expresión regular para validar formato de email estándar
            let regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


            // Validar formato del email
            if(!regexEmail.test(email)){
                errores.push("Email incorrecto");
            }

            // Validar longitud de la contraseña
            if(pass.length < 4){
                errores.push("Contraseña mínimo 4 caracteres");
            }

            // Si hay errores, frenar el envío y mostrarlos en un alert
            if(errores.length > 0){
                e.preventDefault();
                alert(errores.join("\n"));
            }
        });
    }

    // PRODUCTOS
    const producto = document.getElementById("formProducto");

    // Verificar si el formulario de productos existe en la página actual
    if(producto){
        producto.addEventListener("submit", function(e){

            // Capturar valores del nombre (sin espacios extra) y precio
            let nombre = document.querySelector("input[name='nombre']").value.trim();
            let precio = document.querySelector("input[name='precio']").value;

            let errores = [];

            // Expresión regular: Alfanumérico y mínimo 3 caracteres
            let regex = /^[A-Za-z0-9 ]{3,}$/;

            // Validar formato del nombre
            if(!regex.test(nombre)){
                errores.push("Nombre inválido");
            }

            // Validar que el precio sea mayor que cero
            if(precio <= 0){
                errores.push("Precio incorrecto");
            }

            // Si hay errores, frenar el envío y mostrarlos en un alert
            if(errores.length > 0){
                e.preventDefault();
                alert(errores.join("\n"));
            }
        });
    }

});