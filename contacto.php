<?php include("includes/header.php"); ?>

<main>

<h2>Contacto</h2>

<form id="formContacto">

    <label>Nombre</label>
    <input type="text" id="nombre">

    <label>Correo</label>
    <input type="email" id="correo">

    <label>Mensaje</label>
    <textarea id="mensaje"></textarea>

    <button type="submit">Enviar</button>

</form>

<h3>Mensajes enviados</h3>

<div id="resultado"></div>

</main>

<?php include("includes/footer.php"); ?>