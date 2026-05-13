<?php

session_start();

include("includes/conexion.php");

if(!isset($_COOKIE["carrito"])){

    header("Location: carrito.php");
    exit;
}

$productos = explode(",", $_COOKIE["carrito"]);

$contador = [];

/* CONTAR PRODUCTOS */

foreach($productos as $id){

    if($id != ""){

        if(isset($contador[$id])){

            $contador[$id]++;

        } else {

            $contador[$id] = 1;
        }
    }
}

/* GUARDAR PEDIDOS */

foreach($contador as $id => $cantidad){

    $sql = "SELECT * FROM productos WHERE id = :id";

    $query = $conexion->prepare($sql);

    $query->bindParam(":id", $id);

    $query->execute();

    $producto = $query->fetch(PDO::FETCH_ASSOC);

    if($producto){

        $total = $producto["precio"] * $cantidad;

        $insert = "INSERT INTO pedidos 
        (usuario, producto_id, cantidad, total)

        VALUES
        (:usuario, :producto_id, :cantidad, :total)";

        $guardar = $conexion->prepare($insert);

        $guardar->bindParam(":usuario", $_SESSION["usuario"]);

        $guardar->bindParam(":producto_id", $id);

        $guardar->bindParam(":cantidad", $cantidad);

        $guardar->bindParam(":total", $total);

        $guardar->execute();
    }
}

/* VACIAR CARRITO */

setcookie("carrito", "", time() - 3600, "/");

/* REDIRECT */

header("Location: pedido_realizado.php");