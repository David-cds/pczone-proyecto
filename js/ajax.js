$(document).ready(function(){

    $("#cargarProductos").click(function(){

        $.ajax({
            url: "js/ajax_productos.php",
            method: "GET",
            dataType: "json",

            success: function(data){

                let html = "";

                data.forEach(function(p){

                    html += `
                        <div class="card">
                            <p>${p.nombre}</p>
                            <p>${p.precio} €</p>
                        </div>
                    `;

                });

                $("#resultado").html(html);
            }

        });

    });

});