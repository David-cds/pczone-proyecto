<?php 
include("../includes/auth.php"); 
include("../includes/conexion.php");

// Obtener ID por GET
if(!isset($_GET["id"])){
    header("Location: index.php");
    exit();
}

$id = $_GET["id"];

// Obtener datos del producto
$sql = "SELECT * FROM productos WHERE id = :id";
$query = $conexion->prepare($sql);
$query->bindParam(":id", $id);
$query->execute();

$producto = $query->fetch(PDO::FETCH_ASSOC);

// Si no existe el producto
if(!$producto){
    echo "Producto no encontrado";
    exit();
}

// Si se envía el formulario (POST)
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $categoria = $_POST["categoria"];

    $sql = "UPDATE productos 
            SET nombre = :nombre, precio = :precio, categoria = :categoria 
            WHERE id = :id";

    $update = $conexion->prepare($sql);

    $update->bindParam(":nombre", $nombre);
    $update->bindParam(":precio", $precio);
    $update->bindParam(":categoria", $categoria);
    $update->bindParam(":id", $id);

    $update->execute();

    // Redirigir
    header("Location: index.php");
    exit();
}
?>

<h2>Editar producto</h2>

<form method="POST">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" required><br><br>

    <label>Precio:</label><br>
    <input type="number" name="precio" step="0.01" value="<?= $producto['precio'] ?>" required><br><br>

    <label>Categoría:</label><br>
    <select name="categoria">
        <option value="GPU" <?= $producto['categoria']=="GPU" ? "selected" : "" ?>>GPU</option>
        <option value="CPU" <?= $producto['categoria']=="CPU" ? "selected" : "" ?>>CPU</option>
        <option value="RAM" <?= $producto['categoria']=="RAM" ? "selected" : "" ?>>RAM</option>
        <option value="Teclado" <?= $producto['categoria']=="Teclado" ? "selected" : "" ?>>Teclado</option>
        <option value="Raton" <?= $producto['categoria']=="Raton" ? "selected" : "" ?>>Ratón</option>
        <option value="Disco" <?= $producto['categoria']=="Disco" ? "selected" : "" ?>>Disco</option>
    </select><br><br>

    <button type="submit">💾 Guardar cambios</button>

</form>

<br>
<a href="index.php">⬅ Volver</a>