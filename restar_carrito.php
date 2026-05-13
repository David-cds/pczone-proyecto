<?php

$id = $_GET["id"];

$productos = explode(",", $_COOKIE["carrito"]);

$nuevo = "";

$eliminado = false;

foreach($productos as $p){

    if($p == "") continue;

    // borrar SOLO 1
    if($p == $id && $eliminado == false){

        $eliminado = true;

    } else {

        $nuevo .= $p . ",";
    }
}

setcookie("carrito", $nuevo, time()+3600);

header("Location: carrito.php");

?>