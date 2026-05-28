<?php

$id = $_GET["id"];

$carrito = $_COOKIE["carrito"];

$carrito .= $id . ",";

setcookie("carrito", $carrito, time()+3600);

header("Location: carrito.php");

?>