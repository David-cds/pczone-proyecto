<?php

function obtenerPagina($por_pagina){
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    if($pagina < 1) $pagina = 1; if($pagina < 1) $pagina = 1;


    $inicio = ($pagina - 1) * $por_pagina;

    return [$pagina, $inicio];
}

function totalPaginas($conexion, $categoria, $por_pagina){

    $sql = "SELECT COUNT(*) 
            FROM productos
            INNER JOIN categorias ON productos.categoria_id = categorias.id";

    if($categoria != ""){
        $sql .= " WHERE productos.categoria_id = :categoria";
        $query = $conexion->prepare($sql);
        $query->bindParam(":categoria", $categoria);
    } else {
        $query = $conexion->prepare($sql);
    }

    $query->execute();
    $total = $query->fetchColumn();

    return ceil($total / $por_pagina);
}