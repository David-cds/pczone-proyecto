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

    // INSERTAR EN BD
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

    <form action="crear_producto.php" method="POST" enctype="multipart/form-data">
        
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ej. Tarjeta Gráfica RTX 4060" required>

<form method="POST" enctype="multipart/form-data">

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>

        <label for="categoria_id">Categoría:</label>
        <select id="categoria_id" name="categoria_id" required>

        <option value="">Selecciona categoría</option>

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

        <label for="imagen">Imagen del Producto:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" required>

</form>
