<?php

include("includes/conexion.php");
include("includes/header.php");

?>

<main>

<h2 class="admin-title">🛒 Carrito</h2>

<div class="carrito">

<?php

if(isset($_COOKIE["carrito"])){

    $productos = explode(",", $_COOKIE["carrito"]);

    // CONTAR PRODUCTOS
    $contador = [];

    foreach($productos as $id){

        if($id != ""){

            if(isset($contador[$id])){

                $contador[$id]++;

            } else {

                $contador[$id] = 1;
            }
        }
    }

    $total = 0;

    // MOSTRAR PRODUCTOS
    foreach($contador as $id => $cantidad){

        $sql = "SELECT * FROM productos WHERE id = :id";

        $query = $conexion->prepare($sql);

        $query->bindParam(":id", $id);

        $query->execute();

        $producto = $query->fetch(PDO::FETCH_ASSOC);

        if(!$producto){
            continue;
        }

        $subtotal = $producto["precio"] * $cantidad;

        $total += $subtotal;

        ?>

        <div class="carrito-item">

            <!-- IMAGEN -->
            <div class="carrito-img">
                <img class="img-carrito" src="<?= $producto['imagen'] ?>">
            </div>

            <!-- INFO -->
            <div class="carrito-info">

                <h3><?= $producto['nombre'] ?></h3>

                <p>Precio: <?= $producto['precio'] ?> €</p>

                <p>Unidades: <?= $cantidad ?></p>

                <p>
                    <strong>Subtotal:</strong>
                    <?= $subtotal ?> €
                </p>

            </div>

            <!-- BOTONES -->
            <div class="cantidad">

                <a href="restar_carrito.php?id=<?= $id ?>">-</a>

                <span><?= $cantidad ?></span>

                <a href="sumar_carrito.php?id=<?= $id ?>">

            </div>

        </div>

        <?php
    }

    ?>

    <!-- TOTAL -->
    <div class="carrito-total">

        <h2>Total: <?= $total ?> €</h2>

        <div class="carrito-botones">

            <a class="btn-vaciar" href="vaciar_carrito.php">
                Vaciar carrito
            </a>

        </div>

    </div>

<?php

} else {

    echo "<p>El carrito está vacío</p>";
}

?>

</div>

</main>

<?php include("includes/footer.php"); ?>