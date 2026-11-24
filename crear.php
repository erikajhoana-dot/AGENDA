<?php
include __DIR__ . "/incluye/header.php";
include __DIR__ . "/incluye/menu.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/styles.css">
    <title>Crear Contacto</title>
</head>
<body>

    <div id="nuevo-contacto">
        <img src="assets/images/boton-mas.png" alt="Agregar foto">
        <div class="Info-sec">
            <h1>Crear nuevo contacto</h1>
            <p>Completa el formulario para agregar un nuevo contacto</p>
        </div>
    </div>

    <main>

        <?php if (!empty($_GET["error"])): ?>
            <p class="error"><?= htmlspecialchars($_GET["error"], ENT_QUOTES, "UTF-8") ?></p>
        <?php endif; ?>

        <form action="guardar.php" method="POST" enctype="multipart/form-data">

            <div id="columna1-crear">
                <img src="assets/images/boton-mas.png" alt="Seleccionar foto">
                <label for="foto">Seleccionar foto</label>
                <input type="file" id="foto" name="foto" accept="image/jpeg,image/png" required>
                <p>Formatos: JPG, PNG<br>Obligatorio</p>
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
                <button type="submit">Guardar Contacto</button>
            </div>

        </form>

    </main>

</body>
</html>
