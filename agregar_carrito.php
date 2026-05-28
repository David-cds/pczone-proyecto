<?php

$id = $_GET["id"];

if(isset($_COOKIE["carrito"])){

    $carrito = $_COOKIE["carrito"];

} else {

    $carrito = "";
}

// añadir id
$carrito .= $id . ",";

// guardar cookie
setcookie("carrito", $carrito, time()+3600);

header("Location: index.php");

?>