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

   
    $sql = "INSERT INTO productos (nombre, descripcion, precio, categoria, imagen) 
            VALUES (:nombre, :descripcion, :precio, :categoria, :imagen)";

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

// FORMULARIO 

<h2>Añadir Producto</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion"></textarea><br><br>

    <label>Precio:</label><br>
    <input type="number" name="precio" step="0.01" required><br><br>

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

    <button type="submit">Guardar</button>

</form>