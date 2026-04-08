<?php
session_start();

// Comprobar si está logueado
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit();
}

// Comprobar si es admin
if ($_SESSION["rol"] != "admin") {
    header("Location: ../index.php");
    exit();
}
?>