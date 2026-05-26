<?php 
include("includes/header.php"); 
include("includes/conexion.php");
include("includes/funciones.php");

$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : "";
$orden = isset($_POST['orden']) ? $_POST['orden'] : "";

$buscar = isset($_POST['buscar']) ? trim($_POST['buscar']) : "";

// PAGINACIÓN
$por_pagina = 6;
list($pagina, $inicio) = obtenerPagina($por_pagina);

// BASE QUERY
$sql = "SELECT productos.* 
        FROM productos
        INNER JOIN categorias ON productos.categoria_id=categorias.id";

// FILTRO
$where = [];

if($categoria != ""){
    $where[] = "productos.categoria_id = :categoria";
}

if($buscar != ""){
    $where[] = "productos.nombre LIKE :buscar";
}

if(!empty($where)){
    $sql .= " WHERE " . implode(" AND ", $where);
}

// ORDEN
if($orden == "precio_asc"){
    $sql .= " ORDER BY precio ASC";
} elseif($orden == "precio_desc"){
    $sql .= " ORDER BY precio DESC";
} elseif($orden == "nombre"){
    $sql .= " ORDER BY nombre ASC";
}

// PAGINACIÓN
$sql .= " LIMIT $inicio, $por_pagina";

$query = $conexion->prepare($sql);

if($categoria != ""){
    $query->bindParam(":categoria", $categoria);
}

if($buscar != ""){
    $textoBusqueda = "%" . $buscar . "%";
    $query->bindParam(":buscar", $textoBusqueda);
}

$query->execute();
$productos = $query->fetchAll(PDO::FETCH_ASSOC);

// TOTAL PÁGINAS
$total_paginas = totalPaginas($conexion, $categoria, $por_pagina);
?>


<main>

<!--FECHA (DATE JS) -->
<p id="fecha"></p>

<!--BOTÓN JQUERY -->
<button id="toggleProductos">Mostrar/Ocultar productos</button>

<!--AJAX -->
<button id="cargarProductos">Cargar productos (AJAX)</button>

<button id="ocultarProductos">Ocultar productos</button>

<div id="resultado"></div>

<!--SLIDESHOW -->
<div class="slider">
    <img src="img/slideshow/grafica_3060.jpg" class="slide" width="200">
    <img src="img/slideshow/PC_Ryzen.jpg" class="slide" width="200">
    <img src="img/slideshow/portatil_HP.jpg" class="slide" width="200">
</div>


<!-- FILTROS -->
<form method="POST">

     <input type="text" name="buscar" placeholder="Buscar productos..." value="<?php echo isset($_POST['buscar']) ? $_POST['buscar'] : ''; ?>">


    <select name="categoria">
        <option value="">Todas</option>

        <option value="1" <?php if($categoria=="1") echo "selected"; ?>>Portátiles</option>
        <option value="2" <?php if($categoria=="2") echo "selected"; ?>>Sobremesa</option>
        <option value="3" <?php if($categoria=="3") echo "selected"; ?>>Componentes</option>
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
            <img src="<?php echo $producto['imagen']; ?>" width="150">
        </div>

        <p><?php echo $producto['nombre']; ?></p>
        <p><?php echo $producto['precio']; ?> €</p>
        <a href="agregar_carrito.php?id=<?= $producto['id'] ?>">Añadir al carrito</a>

    </div>

<?php } ?>

</section>

</main>

<?php include("includes/footer.php"); ?>