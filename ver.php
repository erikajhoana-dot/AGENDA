<?php
require_once __DIR__ . '/config/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id <= 0) {
    http_response_code(400);
    $contacto = false;
} else {
    $sql = "SELECT
                id,
                nombre,
                apellido,
                telefono,
                foto,
                email,
                direccion,
                notas,
                created_at,
                updated_at
            FROM contactos
            WHERE id = :id";

    $consulta = $pdo->prepare($sql);
    $consulta->execute([':id' => $id]);

    $contacto = $consulta->fetch();

    if (!$contacto) {
        http_response_code(404);
    }
}

$titulo = $contacto
    ? 'Detalles de contacto | Agenda de Contactos'
    : 'Contacto no encontrado | Agenda de Contactos';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css">
    <title><?= htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8') ?></title>
</head>
<body>
    <?php require_once __DIR__ . '/includes/header.php'; ?>
    <?php require_once __DIR__ . '/includes/menu.php'; ?>

    <div id="nuevo-contacto">
        <img src="assets/images/mis-contactos.png" alt="Contactos">

        <div class="Info-sec">
            <h1><?= $contacto ? 'Detalles del contacto' : 'Contacto no encontrado' ?></h1>

            <p>
                <?= $contacto
                    ? 'Consulta toda la información de este contacto'
                    : 'No se encontró el contacto solicitado'
                ?>
            </p>
        </div>
    </div>

    <main>
        <?php if (!$contacto): ?>
            <div class="mensaje-vacio">
                <h2>Contacto no encontrado</h2>

                <p>No existe ningún contacto con el identificador proporcionado.</p>

                <a href="index.php">Volver a contactos</a>
            </div>

        <?php else: ?>
            <div class="detalle-contacto">
                <div class="detalle-fotografia">
                    <?php
                    $rutaFoto = $contacto['foto'];
                    $rutaCompleta = __DIR__ . '/' . $rutaFoto;
                    ?>

                    <?php if (!empty($rutaFoto) && file_exists($rutaCompleta)): ?>
                        <img
                            src="<?= htmlspecialchars($rutaFoto, ENT_QUOTES, 'UTF-8') ?>"
                            alt="Fotografía de <?= htmlspecialchars(
                                $contacto['nombre'] . ' ' . $contacto['apellido'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>"
                            class="foto-detalle"
                        >

                    <?php else: ?>
                        <div class="foto-placeholder foto-detalle-placeholder">
                            <?= htmlspecialchars(
                                strtoupper(substr($contacto['nombre'], 0, 1)),
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="detalle-informacion">
                    <h2>
                        <?= htmlspecialchars(
                            $contacto['nombre'] . ' ' . $contacto['apellido'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </h2>

                    <div class="campo-detalle">
                        <strong>Teléfono</strong>
                        <p>
                            <?= htmlspecialchars($contacto['telefono'], ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </div>

                    <div class="campo-detalle">
                        <strong>Correo electrónico</strong>
                        <p>
                            <?= htmlspecialchars($contacto['email'] ?? 'No especificado', ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </div>

                    <div class="campo-detalle">
                        <strong>Dirección</strong>
                        <p>
                            <?= htmlspecialchars($contacto['direccion'] ?? 'No especificada', ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </div>

                    <div class="campo-detalle">
                        <strong>Notas</strong>
                        <p>
                            <?= nl2br(htmlspecialchars($contacto['notas'] ?? 'Sin notas', ENT_QUOTES, 'UTF-8')) ?>
                        </p>
                    </div>

                    <div class="campo-detalle">
                        <strong>Fecha de registro</strong>
                        <p>
                            <?= htmlspecialchars($contacto['created_at'] ?? 'No disponible', ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </div>

                    <div class="campo-detalle">
                        <strong>Última actualización</strong>
                        <p>
                            <?= htmlspecialchars($contacto['updated_at'] ?? 'No disponible', ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </div>
                </div>

            </div>
            <div class="acciones-formulario">
                <a
                    href="editar.php?id=<?= (int) $contacto['id'] ?>"
                    class="boton boton-primario"
                >
                    Editar contacto
                </a>

                <a
                    href="eliminar.php?id=<?= (int) $contacto['id'] ?>"
                    class="boton boton-eliminar"
                >
                    Eliminar contacto
                </a>

                <a href="index.php" class="boton boton-secundario">
                    Volver a mis contactos
                </a>

            </div>
        <?php endif; ?>
    </main>
</body>
</html>