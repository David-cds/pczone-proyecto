<?php 
include("../includes/auth.php"); 
include("../includes/conexion.php");
include("../includes/header.php");


// Categorías
$queryCat = $conexion->query("SELECT * FROM categorias");
$categorias = $queryCat->fetchAll(PDO::FETCH_ASSOC);


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
    $categoria_id= $_POST["categoria_id"];

    $sql = "UPDATE productos 
            SET nombre = :nombre, precio = :precio, categoria_id= :categoria_id
            WHERE id = :id";

    $update = $conexion->prepare($sql);

    $update->bindParam(":nombre", $nombre);
    $update->bindParam(":precio", $precio);
    $update->bindParam(":categoria_id", $categoria_id);
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
       <?php foreach($categorias as $cat){ ?>
            <option value="<?= $cat['id'] ?>" 
                <?= $producto['categoria_id'] == $cat['id'] ? "selected" : "" ?>>
                <?= $cat['nombre'] ?>
            </option>
        <?php } ?>
    </select><br><br>

    <button type="submit">💾 Guardar cambios</button>

</form>

<br>
<a href="index.php">⬅ Volver</a>


<?php include_once("../includes/footer.php"); ?>