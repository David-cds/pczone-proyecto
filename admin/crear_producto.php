<?php 
include("../includes/auth.php"); 
include("../includes/conexion.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $categoria = $_POST["categoria"];

    // SUBIR IMAGEN
    $imagen = $_FILES["imagen"]["name"];
    $ruta = "../uploads/" . $imagen;

    move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

<<<<<<< Updated upstream
    // INSERTAR EN BD
    $sql = "INSERT INTO productos (nombre, descripcion, precio, categoria, imagen) 
            VALUES (:nombre, :descripcion, :precio, :categoria, :imagen)";
=======
   
    $sql = "INSERT INTO productos (nombre, descripcion, precio, categoria_id,stock,imagen) 
            VALUES (:nombre, :descripcion, :precio, :categoria_id,:stock,:imagen)";
>>>>>>> Stashed changes

    $query = $conexion->prepare($sql);

    $query->bindParam(":nombre", $nombre);
    $query->bindParam(":descripcion", $descripcion);
    $query->bindParam(":precio", $precio);
<<<<<<< Updated upstream
    $query->bindParam(":categoria", $categoria);
    $query->bindParam(":imagen", $imagen);
=======
    $query->bindParam(":categoria_id", $categoria_id);
    $query->bindParam(":stock", $stock);
    $query->bindParam(":imagen", $ruta);
>>>>>>> Stashed changes

    $query->execute();

    echo "<p>Producto añadido correctamente</p>";
}
?>

<<<<<<< Updated upstream
// FORMULARIO 
=======
<main>

    <h2 class="admin-title">Añadir Nuevo Producto</h2>
>>>>>>> Stashed changes

    <form action="crear_producto.php" method="POST" enctype="multipart/form-data">
        
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ej. Tarjeta Gráfica RTX 4060" required>

<<<<<<< Updated upstream
<form method="POST" enctype="multipart/form-data">
=======
        <label for="precio">Precio (€):</label>
        <input type="number" id="precio" name="precio" step="0.01" placeholder="Ej. 299.99" required>
>>>>>>> Stashed changes

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>

        <label for="categoria_id">Categoría:</label>
        <select id="categoria_id" name="categoria_id" required>

        <option value="">Selecciona categoría</option>

<<<<<<< Updated upstream
    <label>Categoría:</label><br>
    <select name="categoria">
        <option value="GPU">GPU</option>
        <option value="CPU">CPU</option>
        <option value="RAM">RAM</option>
        <option value="Teclado">Teclado</option>
        <option value="Raton">Ratón</option>
        <option value="Disco">Disco</option>
    </select><br><br>

    <label>Imagen:</label><br>
    <input type="file" name="imagen" required><br><br>
=======
        <?php foreach($categorias as $categoria){ ?>

            <option value="<?= $categoria['id'] ?>">
                <?= $categoria['nombre'] ?>
            </option>

        <?php } ?>

        </select>

        <label for="stock">Stock Disponible:</label>
        <input type="number" id="stock" name="stock" placeholder="Ej. 15" required>
>>>>>>> Stashed changes

        <label for="imagen">Imagen del Producto:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" required>

<<<<<<< Updated upstream
</form>
=======
        <button type="submit">Guardar Producto</button>
        
        <a href="index.php" class="btn-add" style="margin-top: 15px !important;">Volver al Panel</a>
    </form>

</main>

<?php include_once("../includes/footer.php"); ?>

>>>>>>> Stashed changes
