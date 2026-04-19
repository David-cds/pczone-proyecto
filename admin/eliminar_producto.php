<?php 
include("../includes/auth.php"); 
include("../includes/conexion.php");

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])){

    $id = $_POST["id"];

    $sql = "DELETE FROM productos WHERE id = :id";
    $query = $conexion->prepare($sql);
    $query->bindParam(":id", $id);
    $query->execute();
}

header("Location: index.php");
exit();
?>