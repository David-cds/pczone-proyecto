// VALIDACIÓN DE FORMULARIOS

document.addEventListener("DOMContentLoaded", function(){

    // LOGIN
    const login = document.getElementById("formLogin");

    if(login){
        login.addEventListener("submit", function(e){

            let email = document.querySelector("input[name='email']").value.trim();
            let pass = document.querySelector("input[name='password']").value.trim();

            let errores = [];

            let regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if(!regexEmail.test(email)){
                errores.push("Email incorrecto");
            }

            if(pass.length < 4){
                errores.push("Contraseña mínimo 4 caracteres");
            }

            if(errores.length > 0){
                e.preventDefault();
                alert(errores.join("\n"));
            }
        });
    }

    // PRODUCTOS
    const producto = document.getElementById("formProducto");

    if(producto){
        producto.addEventListener("submit", function(e){

            let nombre = document.querySelector("input[name='nombre']").value.trim();
            let precio = document.querySelector("input[name='precio']").value;

            let errores = [];

            let regex = /^[A-Za-z0-9 ]{3,}$/;

            if(!regex.test(nombre)){
                errores.push("Nombre inválido");
            }

            if(precio <= 0){
                errores.push("Precio incorrecto");
            }

            if(errores.length > 0){
                e.preventDefault();
                alert(errores.join("\n"));
            }
        });
    }

});