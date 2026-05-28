// Detectar clic en el botón con id "cargarProductos"
$("#cargarProductos").click(function(){

    // Abrir una nueva ventana emergente (pop-up) en blanco
    let ventana = window.open(
        "",
        "productos",
        "width=800,height=600"
    );

    // Petición AJAX para obtener los datos de los productos
    $.ajax({

        url: "js/ajax_productos.php",
        method: "GET",
        dataType: "json",

        success: function(data){


            // Crear el título inicial en HTML
            let html = `
                <h2>Productos cargados por AJAX</h2>
            `;

            // Recorrer cada producto y añadirlo al HTML
            data.forEach(function(p){

                html += `
                    <p>
                        ${p.nombre} - ${p.precio} €
                    </p>
                `;
            });

            // Inyectar todo el HTML generado dentro de la nueva ventana
            ventana.document.write(html);

        }

    });

});