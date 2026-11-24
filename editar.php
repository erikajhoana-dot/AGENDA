<?php include __DIR__."/includes/header.php";?>
<?php include __DIR__."/includes/menu.php";?>

<?php

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/styles.css">
    <title>Editar Contacto</title>
</head>
<body>

    <div id="nuevo-contacto">
        <img src="assets/images/editar-usuario.png" alt="Editar contacto">
        <div class="Info-sec">
            <h1>Editar contacto</h1>
            <p>Modifica la información del contacto seleccionado</p>
        </div>
    </div>

    <main>

        <form action="actualizar.php" method="POST">

            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>">

            <div id="columna1-crear">
                <img src="assets/images/boton-mas.png" alt="Foto de contacto">
                <p>Fotografía del contacto</p>
            </div>

            <div id="columna2-crear">

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" required>

                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" required>

                <label for="email">Email (opcional)</label>
                <input type="email" id="email" name="email">

            </div>

            <div id="columna3-crear">

                <label for="direccion">Dirección (opcional)</label>
                <input type="text" id="direccion" name="direccion">

                <label for="notas">Notas (opcional)</label>
                <textarea id="notas" name="notas"></textarea>

            </div>

            <div id="botones-crear">
                <a href="index.php">Cancelar</a>
                <button type="submit">Actualizar Contacto</button>
            </div>

        </form>

    </main>

</body>
</html>
