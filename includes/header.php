<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
</head>
<body>
    <header>
        <div class="logo-box">Logo</div>
        <div class="brand">PCZone</div>
    </header>

<<<<<<< Updated upstream
    <nav>
        <a href="index.php">Inicio</a>
        <a href="productos.php">Ofertas</a>
        <a href="#">En Tendencia</a>
        <a href="#">Mas Buscado</a>
    </nav>
</body>
</html>
=======
<header>
    <div class="logo-box">
    <a href="<?= $rutaBase ?>index.php">
        <img src="<?= $rutaBase ?>img/banner/logo.png" alt="Logo PCZone" class="logo">
    </a>
    </div>
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
    <a href="<?= $rutaBase ?>sobre-nosotros.php">Sobre Nosotros</a>
    <a href="<?= $rutaBase ?>ayuda.php">Ayuda</a>
    <a href="<?= $rutaBase ?>contacto.php">Contacto</a>
</nav> 
>>>>>>> Stashed changes
