<?php if(session_status()===PHP_SESSION_NONE){
    session_start();
}
include("includes/conexion.php");

$error = "";

$sql="SELECT usuarios.id as id,
usuarios.nombre as nombre,
usuarios.email as email,
usuarios.password as clave,
roles.rol AS rol

FROM usuarios 
INNER JOIN roles ON usuarios.id_rol=roles.id 

WHERE usuarios.password = :password 
AND usuarios.email = :email";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Consulta preparada
    $query = $conexion->prepare($sql);
    
    $query->bindParam(":email", $email);
    $query->bindParam(":password", $password);

    $query->execute();

    if ($query->rowCount() == 1) {

        $usuario = $query->fetch(PDO::FETCH_ASSOC);

        $_SESSION["id"] = $usuario["id"];
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