<?php
require_once __DIR__ . '/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

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

$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$email = trim($_POST['email'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$notas = trim($_POST['notas'] ?? '');

if ($nombre === '' || $apellido === '' || $telefono === '') {
    header('Location: editar.php?id=' . $id . '&error=' . urlencode('Completa los campos obligatorios.'));
    exit;
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: editar.php?id=' . $id . '&error=' . urlencode('El correo electrónico no es válido.'));
    exit;
}

$rutaFoto = $contacto['foto'];
$rutaNuevaFoto = null;

if (isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {
    if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
        header('Location: editar.php?id=' . $id . '&error=' . urlencode('Error al subir la fotografía.'));
        exit;
    }

    if ($_FILES['foto']['size'] > 2 * 1024 * 1024) {
        header('Location: editar.php?id=' . $id . '&error=' . urlencode('La fotografía no debe superar los 2 MB.'));
        exit;
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $tipoMime = $finfo->file($_FILES['foto']['tmp_name']);

    $tiposPermitidos = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png'
    ];

    if (!isset($tiposPermitidos[$tipoMime]) || getimagesize($_FILES['foto']['tmp_name']) === false) {
        header('Location: editar.php?id=' . $id . '&error=' . urlencode('La fotografía debe ser JPG o PNG válida.'));
        exit;
    }

    $extension = $tiposPermitidos[$tipoMime];
    $nombreArchivo = bin2hex(random_bytes(16)) . '.' . $extension;

    $directorio = __DIR__ . '/archivos/';

    if (!is_dir($directorio)) {
        mkdir($directorio, 0755, true);
    }

    $rutaDestino = $directorio . $nombreArchivo;
    $rutaNuevaFoto = 'archivos/' . $nombreArchivo;

    if (!move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
        header('Location: editar.php?id=' . $id . '&error=' . urlencode('No se pudo guardar la nueva fotografía.'));
        exit;
    }

    $rutaFoto = $rutaNuevaFoto;
}

try {
    $sql = "UPDATE contactos SET
                nombre = :nombre,
                apellido = :apellido,
                telefono = :telefono,
                foto = :foto,
                email = :email,
                direccion = :direccion,
                notas = :notas
            WHERE id = :id";

    $consulta = $pdo->prepare($sql);

    $consulta->execute([
        ':nombre' => $nombre,
        ':apellido' => $apellido,
        ':telefono' => $telefono,
        ':foto' => $rutaFoto,
        ':email' => $email !== '' ? $email : null,
        ':direccion' => $direccion !== '' ? $direccion : null,
        ':notas' => $notas !== '' ? $notas : null,
        ':id' => $id
    ]);

    header('Location: index.php');
    exit;

} catch (PDOException $e) {
    if ($rutaNuevaFoto !== null && file_exists(__DIR__ . '/' . $rutaNuevaFoto)) {
        unlink(__DIR__ . '/' . $rutaNuevaFoto);
    }

    header('Location: editar.php?id=' . $id . '&error=' . urlencode('No se pudo actualizar el contacto.'));
    exit;
}