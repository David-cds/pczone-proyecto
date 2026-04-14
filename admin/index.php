<?php 
include("../includes/auth.php"); 
include("../includes/conexion.php");

// Productos por página
$por_pagina = 5;

// Página actual (mínimo 1)
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if($pagina < 1) $pagina = 1;

// Inicio
$inicio = ($pagina - 1) * $por_pagina;

// Consulta
$sql = "SELECT * FROM productos LIMIT $inicio, $por_pagina";
$productos = $conexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// Total productos
$total = $conexion->query("SELECT COUNT(*) FROM productos")->fetchColumn();

// Total páginas
$total_paginas = ceil($total / $por_pagina);
?>

<h2>Panel Admin</h2>

<a href="crear_producto.php"> Añadir producto</a>

<table border="1">
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Precio</th>
    <th>Acciones</th>
</tr>

<?php foreach($productos as $p){ ?>
<tr>
    <td><?= $p['id'] ?></td>
    <td><?= $p['nombre'] ?></td>
    <td><?= $p['precio'] ?>€</td>
    <td>
        <a href="editar_producto.php?id=<?= $p['id'] ?>">✏️ Editar</a> |
        <a href="eliminar_producto.php?id=<?= $p['id'] ?>"onclick="return confirm('¿Borrar producto?')">Borrar </a>
    </td>
</tr>
<?php } ?>

</table>

<!-- PAGINACIÓN -->
<div>

<?php if($pagina > 1){ ?>
    <a href="?pagina=<?= $pagina-1 ?>">⬅ Anterior</a>
<?php } ?>

<?php for($i=1; $i <= $total_paginas; $i++){ ?>
    <a href="?pagina=<?= $i ?>" 
       style="font-weight: <?= ($i == $pagina) ? 'bold' : 'normal' ?>">
       <?= $i ?>
    </a>
<?php } ?>

<?php if($pagina < $total_paginas){ ?>
    <a href="?pagina=<?= $pagina+1 ?>">Siguiente ➡</a>
<?php } ?>

</div>