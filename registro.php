<?php
include("includes/conexion.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"]; 

    // Comprobar si existe el correo
    $check = $conexion->prepare("SELECT * FROM usuarios WHERE email = :email");
    $check->bindParam(":email", $email);
    $check->execute();

    if ($check->rowCount() > 0) {
        $mensaje = "El email ya está registrado";
    } else {
        
        $query = $conexion->prepare("INSERT INTO usuarios (nombre, email, password, id_rol) 
                                     VALUES (:nombre, :email, :password, 2)");

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
    <h2 class="admin-title">Registro</h2>

    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Registrarse</button>
    </form>

    <?php if(!empty($mensaje)) { ?>
        <p style="text-align: center; font-weight: bold; margin-top: 15px; color: #000000;"><?= $mensaje ?></p>
    <?php } ?>
</main>

<?php include("includes/footer.php"); ?>