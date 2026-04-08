<?php
session_start();
include("includes/conexion.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Consulta preparada
    $query = $conexion->prepare("SELECT * FROM usuarios WHERE email = :email AND password = :password");
    
    $query->bindParam(":email", $email);
    $query->bindParam(":password", $password);

    $query->execute();

    if ($query->rowCount() == 1) {

        $usuario = $query->fetch(PDO::FETCH_ASSOC);

        $_SESSION["usuario"] = $usuario["nombre"];
        $_SESSION["rol"] = $usuario["rol"];

        header("Location: index.php");
        exit();

    } else {
        $error = "Email o contraseña incorrectos";
    }
}
?>

<?php include("includes/header.php"); ?>

<main>

<h2>Iniciar sesión</h2>

<form method="POST">

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Entrar</button>

</form>

<p style="color:red;">
    <?php echo $error; ?>
</p>

</main>

<?php include("includes/footer.php"); ?>