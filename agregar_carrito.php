<?php

include("includes/conexion.php");

$id = $_GET["id"];

// COMPROBAR STOCK
$sql = "SELECT stock FROM productos WHERE id = :id";

$query = $conexion->prepare($sql);


$query->bindParam(":id", $id);

$query->execute();

$producto = $query->fetch(PDO::FETCH_ASSOC);

// SI NO HAY STOCK
if($producto['stock'] <= 0){

    echo "Producto sin stock";
    exit();

}

if(isset($_COOKIE["carrito"])){

    $carrito = $_COOKIE["carrito"];

} else {

    $carrito = "";
}

// añadir id
$carrito .= $id . ",";

// guardar cookie
setcookie("carrito", $carrito, time()+3600);

// RESTAR STOCK
$sqlStock = "UPDATE productos
             SET stock = stock - 1
             WHERE id = :id";

$queryStock = $conexion->prepare($sqlStock);

$queryStock->bindParam(":id", $id);

$queryStock->execute();

// VOLVER
header("Location: index.php");

?>