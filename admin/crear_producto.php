<?php 
include("../includes/auth.php"); 
include("../includes/conexion.php");
include("../includes/header.php");


// Obtener categorías
$queryCat = $conexion->query("SELECT * FROM categorias");
$categorias = $queryCat->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $categoria_id = $_POST["categoria_id"];
    $stock = $_POST["stock"];

    // SUBIR IMAGEN
    $imagen = $_FILES["imagen"]["name"];
    $ruta = "img/productos/" . $imagen;

    move_uploaded_file($_FILES["imagen"]["tmp_name"], "../". $ruta);

   
    $sql = "INSERT INTO productos (nombre, descripcion, precio, categoria_id,stock,imagen) 
            VALUES (:nombre, :descripcion, :precio, :categoria_id,:stock,:imagen)";

    $query = $conexion->prepare($sql);

    $query->bindParam(":nombre", $nombre);
    $query->bindParam(":descripcion", $descripcion);
    $query->bindParam(":precio", $precio);
    $query->bindParam(":categoria_id", $categoria_id);
    $query->bindParam(":stock", $stock);
    $query->bindParam(":imagen", $ruta);

    $query->execute();

    echo "<p>Producto añadido correctamente</p>";
}
?>

<main>

    <h2 class="admin-title">Añadir Nuevo Producto</h2>

    <form action="crear_producto.php" method="POST" enctype="multipart/form-data">
        
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ej. Tarjeta Gráfica RTX 4060" required>

        <label for="precio">Precio (€):</label>
        <input type="number" id="precio" name="precio" step="0.01" placeholder="Ej. 299.99" required>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>

        <label for="categoria_id">Categoría:</label>
        <select id="categoria_id" name="categoria_id" required>

        <option value="">Selecciona categoría</option>

        <?php foreach($categorias as $categoria){ ?>

            <option value="<?= $categoria['id'] ?>">
                <?= $categoria['nombre'] ?>
            </option>

        <?php } ?>

        </select>

        <label for="stock">Stock Disponible:</label>
        <input type="number" id="stock" name="stock" placeholder="Ej. 15" required>

        <label for="imagen">Imagen del Producto:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" required>

        <button type="submit">Guardar Producto</button>
        
        <a href="index.php" class="btn-add" style="margin-top: 15px !important;">Volver al Panel</a>
    </form>

</main>

<?php include_once("../includes/footer.php"); ?>

