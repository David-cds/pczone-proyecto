<?php if(session_status()===PHP_SESSION_NONE){
    session_start();
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <div class="logo-box">Logo</div>
        <div class="brand">PCZone</div>

        <div class="usuario">

    <?php if(isset($_SESSION['usuario'])){ ?>

        👤 <?php echo $_SESSION['usuario']; ?>

        <a href="logout.php">Cerrar sesión</a>

        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'){ ?>
            <a href="admin/index.php">Panel Admin</a>
        <?php } ?>

    <?php } else { ?>

        <a href="login.php">Iniciar sesión</a>
        <a href="registro.php">Registrarse</a>

    <?php } ?>

    </div>
    </header>

    <nav>
        <a href="index.php">Inicio</a>
        <a href="productos.php">Ofertas</a>
        <a href="#">En Tendencia</a>
        <a href="#">Mas Buscado</a>
    </nav>
