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

    <main>
        <h2>Nuevo Contacto</h2>

        <?php if (!empty($_GET["error"])): ?>
            <p class="error"><?= htmlspecialchars($_GET["error"], ENT_QUOTES, "UTF-8") ?></p>
        <?php endif; ?>

        <form action="guardar.php" method="POST" enctype="multipart/form-data">

            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" required>
            <br><br>

            <label for="apellido">Apellido:</label><br>
            <input type="text" id="apellido" name="apellido" required>
            <br><br>

            <label for="telefono">Teléfono:</label><br>
            <input type="text" id="telefono" name="telefono" required>
            <br><br>

            <label for="foto">Foto:</label><br>
            <input type="file" id="foto" name="foto" accept="image/*" required>
            <br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email">
            <br><br>

            <label for="direccion">Dirección:</label><br>
            <input type="text" id="direccion" name="direccion">
            <br><br>

            <label for="notas">Notas:</label><br>
            <textarea id="notas" name="notas"></textarea>
            <br><br>

            <button type="submit">Guardar Contacto</button>
            <a href="index.php">Cancelar</a>

        </form>
    </main>

</body>
</html>
