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

    // SUBIR IMAGEN
    $imagen = $_FILES["imagen"]["name"];
    $ruta = "../uploads/" . $imagen;

    move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

   
    $sql = "INSERT INTO productos (nombre, descripcion, precio, categoria_id, imagen) 
            VALUES (:nombre, :descripcion, :precio, :categoria_id, :imagen)";

    $query = $conexion->prepare($sql);

    $query->bindParam(":nombre", $nombre);
    $query->bindParam(":descripcion", $descripcion);
    $query->bindParam(":precio", $precio);
    $query->bindParam(":categoria", $categoria);
    $query->bindParam(":imagen", $imagen);

    $query->execute();

    echo "<p>Producto añadido correctamente</p>";
}
?>



<h2>Añadir Producto</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion"></textarea><br><br>

    <label>Precio:</label><br>
    <input type="number" name="precio" step="0.01" required><br><br>

    <label>Categoría:</label><br>
    <select name="categoria_id">
         <?php foreach($categorias as $cat){ ?>
            <option value="<?= $cat['id'] ?>">
                <?= $cat['nombre'] ?>
            </option>
        <?php } ?>
    </select><br><br>

    <label>Imagen:</label><br>
    <input type="file" name="imagen" required><br><br>

    <button type="submit">Guardar</button>

</form>

<?php include_once("../includes/footer.php"); ?>