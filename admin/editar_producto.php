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
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $categoria_id = $_POST["categoria_id"];
    $stock = $_POST["stock"];

    $rutaImagen = $producto['imagen'];

if(!empty($_FILES["imagen"]["name"])){

    $imagen = $_FILES["imagen"]["name"];

    $rutaImagen = "img/productos/" . $imagen;

    move_uploaded_file(
        $_FILES["imagen"]["tmp_name"],
        "../" . $rutaImagen
    );
}

   $sql = "UPDATE productos 
        SET nombre = :nombre,
        descripcion = :descripcion,
        precio = :precio,
        categoria_id = :categoria_id,
        stock = :stock,
        imagen = :imagen
        WHERE id = :id";

    $update = $conexion->prepare($sql);

    $update->bindParam(":nombre", $nombre);
    $update->bindParam(":precio", $precio);
    $update->bindParam(":categoria_id", $categoria_id);
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

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?= htmlspecialchars($producto['descripcion']) ?></textarea>

        <label for="precio">Precio (€):</label>
        <input type="number" id="precio" name="precio" step="0.01" value="<?= $producto['precio'] ?>" required>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" value="<?= $producto['stock'] ?>"required>

        <label for="categoria_id">Categoría:</label>
        <select id="categoria_id" name="categoria_id">
           <?php foreach($categorias as $cat){ ?>
                <option value="<?= $cat['id'] ?>" 
                    <?= $producto['categoria_id'] == $cat['id'] ? "selected" : "" ?>>
                    <?= htmlspecialchars($cat['nombre']) ?>
                </option>
            <?php } ?>
        </select>

        <label>Imagen actual:</label>
        <img src="../<?= $producto['imagen'] ?>" width="120">
        <label for="imagen">Nueva imagen:</label>
        <input type="file" name="imagen">

        <button type="submit">Guardar cambios</button>
        
        <a href="index.php" class="btn-add" style="margin-top: 15px !important;">⬅ Volver al Panel</a>
    </form>

</main>

<?php include_once("../includes/footer.php"); ?>