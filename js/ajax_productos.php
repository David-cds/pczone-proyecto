<?php
include("includes/conexion.php");

$query = $conexion->query("SELECT nombre, precio FROM productos LIMIT 5");
$productos = $query->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($productos);

?>