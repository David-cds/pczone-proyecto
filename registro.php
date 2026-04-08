<?php
include("includes/conexion.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Comprobar si existe
    $check = $conexion->prepare("SELECT * FROM usuarios WHERE email = :email");
    $check->bindParam(":email", $email);
    $check->execute();

    if ($check->rowCount() > 0) {

        $mensaje = "El email ya está registrado";

    } else {

        // Insertar usuario
        $query = $conexion->prepare("INSERT INTO usuarios (nombre, email, password, rol) 
                                     VALUES (:nombre, :email, :password, 'usuario')");

        $query->bindParam(":nombre", $nombre);
        $query->bindParam(":email", $email);
        $query->bindParam(":password", $password);

        if ($query->execute()) {
            $mensaje = "Usuario registrado correctamente";
        } else {
            $mensaje = "Error al registrar";
        }
    }
}
?>

<?php include("includes/header.php"); ?>

<main>

<h2>Registro</h2>

<form method="POST">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Registrarse</button>

</form>

<p><?php echo $mensaje; ?></p>

</main>

<?php include("includes/footer.php"); ?>