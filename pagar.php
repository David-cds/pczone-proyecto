<?php

session_start();

include("includes/conexion.php");

if(!isset($_SESSION["id"])){

    header("Location: login.php");
    exit;
}

if(!isset($_COOKIE["carrito"])){

    header("Location: carrito.php");
    exit;
}

$productos = explode(",", $_COOKIE["carrito"]);

$total = 0;

/* CALCULAR TOTAL */

foreach($productos as $idProducto){

    if($idProducto != ""){

        $sql = "SELECT * FROM productos WHERE id = :id";

        $query = $conexion->prepare($sql);

        $query->bindParam(":id", $idProducto);

        $query->execute();

        $producto = $query->fetch(PDO::FETCH_ASSOC);

        if($producto){

            $total += $producto["precio"];
        }
    }
}

/* GUARDAR PEDIDO */

$sqlPedido = "INSERT INTO pedidos 
(usuario_id, total, fecha)

VALUES
(:usuario_id, :total, NOW())";

$queryPedido = $conexion->prepare($sqlPedido);

$queryPedido->bindParam(":usuario_id", $_SESSION["id"]);

$queryPedido->bindParam(":total", $total);

$queryPedido->execute();

/* VACIAR CARRITO */

setcookie("carrito", "", time() - 3600, "/");

/* REDIRECT */

header("Location: pedido_realizado.php");
exit;

?>