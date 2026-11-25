<?php
require_once __DIR__ . '/config/db.php';

$error = '';
$contacto = false;

$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
} else {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
}

if (!$id || $id <= 0) {
    $error = 'No se proporcionó un contacto válido.';
} else {
    $sql = "SELECT id, nombre, apellido FROM contactos WHERE id = :id";

    $consulta = $pdo->prepare($sql);
    $consulta->execute([':id' => $id]);

    $contacto = $consulta->fetch();

    if (!$contacto) {
        $error = 'El contacto que intentas eliminar no existe.';
    } elseif ($metodo === 'POST') {
        $sql = "DELETE FROM contactos WHERE id = :id";

        $consulta = $pdo->prepare($sql);
        $consulta->execute([':id' => $id]);

        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css">
    <title>Eliminar Contacto</title>
</head>
<body>
    <?php include __DIR__ . "/includes/header.php"; ?>
    <?php include __DIR__ . "/includes/menu.php"; ?>

    <div id="nuevo-contacto">
        <img src="assets/images/eliminar-contacto.png" alt="Eliminar contacto">
        <div class="Info-sec">
            <h1>Eliminar contacto</h1>
            <p>Confirma si deseas eliminar este contacto de tu agenda</p>
        </div>
    </div>

    <main>
        <?php if ($error !== ''): ?>
            <div class="mensaje-vacio">
                <h2>No se puede eliminar el contacto</h2>
                <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
                <a href="index.php">Volver a mis contactos</a>
            </div>
        <?php else: ?>

            <div class="confirmacion-eliminar">
                <h2>¿Estás seguro de que deseas eliminar a 
                    <strong>
                        <?= htmlspecialchars(
                            $contacto['nombre'] . ' ' . $contacto['apellido'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </strong>?
                </h2>

                <p class="texto-advertencia">Esta acción no se puede deshacer.</p>

                <form action="eliminar.php" method="POST" class="form-confirmacion">
                    <input type="hidden" name="id" value="<?= (int) $contacto['id'] ?>">

                    <a href="ver.php?id=<?= (int) $contacto['id'] ?>" class="boton boton-secundario">
                        Cancelar
                    </a>

                    <button type="submit" class="boton boton-eliminar">
                        Sí, eliminar
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>