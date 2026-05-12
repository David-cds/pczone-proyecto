<?php 
if(session_status()===PHP_SESSION_NONE){
    session_start();
}

// Detectar si estamos en /admin/
$enAdmin = (strpos($_SERVER['PHP_SELF'], '/admin/') !== false);

// Ruta base dinámica
$rutaBase = $enAdmin ? '../' : '';
$rutaCSS = $enAdmin ? '../css/estilos.css' : 'css/estilos.css';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCZone</title>

    <link rel="stylesheet" href="<?= $rutaCSS ?>">
</head>

<body>

<header>
    <div class="logo-box">Logo</div>
    <div class="brand">PCZone</div>

    <div class="usuario">

    <?php if(isset($_SESSION['usuario'])){ ?>

        👤 <?= $_SESSION['usuario']; ?>

        <a href="<?= $rutaBase ?>logout.php">Cerrar sesión</a>

        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'){ ?>
            <a href="<?= $rutaBase ?>admin/index.php">Panel Admin</a>
        <?php } ?>

    <?php } else { ?>

        <a href="<?= $rutaBase ?>login.php">Iniciar sesión</a>
        <a href="<?= $rutaBase ?>registro.php">Registrarse</a>

    <?php } ?>

    <a href="<?= $rutaBase ?>carrito.php">🛒 Carrito</a>

    </div>
</header>

<nav>
    <a href="<?= $rutaBase ?>index.php">Inicio</a>
    <a href="<?= $rutaBase ?>productos.php">Ofertas</a>
    <a href="#">En Tendencia</a>
    <a href="#">Más buscado</a>
</nav> 