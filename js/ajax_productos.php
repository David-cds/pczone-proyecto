<?php
// Conectar a la base de datos
include("../includes/conexion.php");


// Consultar nombre y precio de los productos
$query = $conexion->query("SELECT nombre, precio FROM productos");
$productos = $query->fetchAll(PDO::FETCH_ASSOC);

// Definir que la respuesta será un JSON
header("Content-Type: application/json");

// Enviar los datos convertidos a JSON
echo json_encode($productos);
?>