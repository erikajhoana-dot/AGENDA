<?php
require_once __DIR__ . '/config/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id <= 0) {
    header('Location: index.php');
    exit;
}

$sql = "SELECT * FROM contactos WHERE id = :id";

$consulta = $pdo->prepare($sql);
$consulta->execute([':id' => $id]);

$contacto = $consulta->fetch();

if (!$contacto) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css">
    <title>Editar Contacto</title>
</head>
<body>
    <?php include __DIR__ . "/includes/header.php"; ?>
    <?php include __DIR__ . "/includes/menu.php"; ?>

    <div id="nuevo-contacto">
        <img src="assets/images/editar-usuario.png" alt="Editar contacto">
        <div class="Info-sec">
            <h1>Editar contacto</h1>
            <p>Modifica la información del contacto seleccionado</p>
        </div>
    </div>

    <main>
        <?php if (!empty($_GET["error"])): ?>
            <p class="error"><?= htmlspecialchars($_GET["error"], ENT_QUOTES, "UTF-8") ?></p>
        <?php endif; ?>

        <form action="actualizar.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= (int) $contacto['id'] ?>">

            <div id="columna1-crear">
                <?php if (!empty($contacto['foto']) && file_exists(__DIR__ . '/' . $contacto['foto'])): ?>
                    <img
                        class="foto-editar"
                        src="<?= htmlspecialchars($contacto['foto'], ENT_QUOTES, 'UTF-8') ?>"
                        alt="Foto de contacto"
                    >
                <?php else: ?>
                    <img src="assets/images/boton-mas.png" alt="Foto de contacto">
                <?php endif; ?>

                <input type="file" id="foto" name="foto" accept="image/jpeg,image/png">
                <p>Selecciona una nueva fotografía si deseas reemplazarla.</p>
            </div>

            <div id="columna2-crear">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre"
                       value="<?= htmlspecialchars($contacto['nombre'], ENT_QUOTES, 'UTF-8') ?>"
                       required>

                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido"
                       value="<?= htmlspecialchars($contacto['apellido'], ENT_QUOTES, 'UTF-8') ?>"
                       required>

                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono"
                       value="<?= htmlspecialchars($contacto['telefono'], ENT_QUOTES, 'UTF-8') ?>"
                       required>

                <label for="email">Email (opcional)</label>
                <input type="email" id="email" name="email"
                       value="<?= htmlspecialchars($contacto['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            </div>

            <div id="columna3-crear">
                <label for="direccion">Dirección (opcional)</label>
                <input type="text" id="direccion" name="direccion"
                       value="<?= htmlspecialchars($contacto['direccion'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

                <label for="notas">Notas (opcional)</label>
                <textarea id="notas" name="notas"
                ><?= htmlspecialchars($contacto['notas'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>

            <div id="botones-crear">
                <a href="index.php">Cancelar</a>
                <button type="submit">Actualizar Contacto</button>
            </div>
        </form>
    </main>
</body>
</html>