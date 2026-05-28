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
    $descripcion = $_POST["descripcion"];
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
    $update->bindParam(":descripcion", $descripcion);
    $update->bindParam(":stock", $stock);
    $update->bindParam(":imagen", $rutaImagen);

    $update->execute();

    // Redirigir
    header("Location: index.php");
    exit();
}
?>

<main>

    <h2 class="admin-title">Editar producto</h2>

    <form method="POST" enctype="multipart/form-data">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required>

    <label>Categoría:</label><br>
    <select name="categoria">
        <option value="GPU" <?= $producto['categoria']=="GPU" ? "selected" : "" ?>>GPU</option>
        <option value="CPU" <?= $producto['categoria']=="CPU" ? "selected" : "" ?>>CPU</option>
        <option value="RAM" <?= $producto['categoria']=="RAM" ? "selected" : "" ?>>RAM</option>
        <option value="Teclado" <?= $producto['categoria']=="Teclado" ? "selected" : "" ?>>Teclado</option>
        <option value="Raton" <?= $producto['categoria']=="Raton" ? "selected" : "" ?>>Ratón</option>
        <option value="Disco" <?= $producto['categoria']=="Disco" ? "selected" : "" ?>>Disco</option>
    </select><br><br>

        <label for="precio">Precio (€):</label>
        <input type="number" id="precio" name="precio" step="0.01" value="<?= $producto['precio'] ?>" required>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" value="<?= $producto['stock'] ?>"required>

<br>
<a href="index.php">⬅ Volver</a>
