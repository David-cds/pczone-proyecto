<?php 
include("includes/header.php"); 
include("includes/conexion.php");
include("includes/funciones.php");

$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : "";
$orden = isset($_POST['orden']) ? $_POST['orden'] : "";

// PAGINACIÓN
$por_pagina = 6;
list($pagina, $inicio) = obtenerPagina($por_pagina);

// BASE QUERY
$sql = "SELECT * FROM productos";

// FILTRO
if($categoria != ""){
    $sql .= " WHERE categoria = :categoria";
}

// ORDEN
if($orden == "precio_asc"){

    $sql .= " ORDER BY precio ASC";

}
elseif($orden == "precio_desc"){

    $sql .= " ORDER BY precio DESC";

}
elseif($orden == "nombre"){

    $sql .= " ORDER BY nombre ASC";

}
else{

    // MOSTRAR LOS PRODUCTOS MÁS NUEVOS PRIMERO
    $sql .= " ORDER BY productos.id DESC";

}

// PAGINACIÓN
$sql .= " LIMIT $inicio, $por_pagina";

$query = $conexion->prepare($sql);

if($categoria != ""){
    $query->bindParam(":categoria", $categoria);
}

$query->execute();
$productos = $query->fetchAll(PDO::FETCH_ASSOC);

// TOTAL PÁGINAS
$total_paginas = totalPaginas($conexion, $categoria, $por_pagina);
?>


<main>

<!-- FILTROS -->
<form method="POST">

    <select name="categoria">
        <option value="">Todas</option>
        <option value="GPU" <?php if($categoria=="GPU") echo "selected"; ?>>Tarjetas gráficas</option>
        <option value="CPU" <?php if($categoria=="CPU") echo "selected"; ?>>Procesadores</option>
        <option value="RAM" <?php if($categoria=="RAM") echo "selected"; ?>>RAM</option>
        <option value="Teclado" <?php if($categoria=="Teclado") echo "selected"; ?>>Teclados</option>
        <option value="Raton" <?php if($categoria=="Raton") echo "selected"; ?>>Ratón</option>
        <option value="Disco" <?php if($categoria=="Disco") echo "selected"; ?>>Discos duros</option>
    </select>

    <select name="orden">
        <option value="">Ordenar</option>
        <option value="precio_asc" <?php if($orden=="precio_asc") echo "selected"; ?>>Precio ↑</option>
        <option value="precio_desc" <?php if($orden=="precio_desc") echo "selected"; ?>>Precio ↓</option>
        <option value="nombre" <?php if($orden=="nombre") echo "selected"; ?>>A-Z</option>
    </select>

    <button type="submit">Filtrar</button>

</form>

<!-- PRODUCTOS -->
<section class="productos">

<?php if(empty($productos)){ ?>
    <p>No hay productos</p>
<?php } ?>

<?php foreach($productos as $producto){ ?>

    <div class="card">

        <div class="img">
            <img src="uploads/<?php echo $producto['imagen']; ?>" width="150">
        </div>

        <p><?php echo $producto['nombre']; ?></p>
        <p><?php echo $producto['descripcion']; ?></p>
        <p><?php echo $producto['precio']; ?> €</p>
<<<<<<< Updated upstream
=======
        <p>Stock: <?= $producto['stock'] ?></p>
        <?php if($producto['stock'] > 0){ ?>

        <a href="agregar_carrito.php?id=<?= $producto['id'] ?>"> Añadir al carrito</a>

        <?php } else { ?>
            <p style="color:red;">Sin stock</p>
        <?php } ?>
>>>>>>> Stashed changes

    </div>

<?php } ?>

</section>

<div class="paginacion">

<?php for($i = 1; $i <= $total_paginas; $i++){ ?>

    <a href="?pagina=<?= $i ?>">
        <?= $i ?>
    </a>

<?php } ?>

</div>

</main>

<?php include("includes/footer.php"); ?>