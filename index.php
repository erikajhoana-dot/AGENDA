<?php
require_once __DIR__ . '/config/db.php';

$busqueda = trim($_GET['busqueda'] ?? '');

$sql = "SELECT * FROM contactos";

if ($busqueda !== '') {
    $sql .= " WHERE
                nombre LIKE :nombre
                OR apellido LIKE :apellido
                OR telefono LIKE :telefono
                OR email LIKE :email";

    $termino = '%' . $busqueda . '%';

    $consulta = $pdo->prepare($sql);

    $consulta->execute([
        ':nombre' => $termino,
        ':apellido' => $termino,
        ':telefono' => $termino,
        ':email' => $termino
    ]);
} else {
    $sql .= " ORDER BY apellido ASC, nombre ASC";

    $consulta = $pdo->query($sql);
}

$contactos = $consulta->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css">
    <title>Agenda de Contactos</title>
</head>
<body>
    <?php include __DIR__ . "/includes/header.php"; ?>
    <?php include __DIR__ . "/includes/menu.php"; ?>

    <main>
        <h1>Mis contactos</h1>

        <p class="descripcion">
            Administra y busca tus contactos desde un solo lugar.
        </p>

        <form class="formulario-busqueda" action="index.php" method="GET">
            <input type="search" name="busqueda"
                placeholder="Buscar por nombre, apellido, teléfono o correo..."
                value="<?= htmlspecialchars($busqueda, ENT_QUOTES, 'UTF-8') ?>"
            >

            <button type="submit" class="boton boton-primario">Buscar</button>

            <?php if ($busqueda !== ''): ?>
                <a href="index.php" class="boton boton-secundario">Limpiar</a>
            <?php endif; ?>
        </form>

        <?php if (count($contactos) > 0): ?>
            <table class="tabla-contactos">
                <thead>
                    <tr>
                        <th>Fotografía</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($contactos as $contacto): ?>
                        <tr>
                            <td>
                                <?php if (!empty($contacto['foto']) &&
                                    file_exists(__DIR__ . '/' . $contacto['foto'])): ?>
                                    <img
                                        src="<?= htmlspecialchars($contacto['foto'], ENT_QUOTES, 'UTF-8') ?>"
                                        alt="Foto del contacto"
                                    >
                                <?php else: ?>
                                    Sin fotografía
                                <?php endif; ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $contacto['nombre'] . ' ' . $contacto['apellido'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $contacto['telefono'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $contacto['email'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>

                            <td>
                                <a href="ver.php?id=<?= (int) $contacto['id'] ?>">
                                    Ver detalles
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <div class="mensaje-vacio">
                <?php if ($busqueda !== ''): ?>
                    <h2>No se encontraron resultados</h2>

                    <p>
                        No hay contactos que coincidan con
                        "<?= htmlspecialchars($busqueda, ENT_QUOTES, 'UTF-8') ?>".
                    </p>
                <?php else: ?>
                    <h2>No hay contactos registrados</h2>

                    <p>Cuando agregues contactos, aparecerán aquí.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>