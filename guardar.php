<?php
require_once __DIR__ . '/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: crear.php');
    exit;
}

$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$email = trim($_POST['email'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$notas = trim($_POST['notas'] ?? '');

if ($nombre === '' || $apellido === '' || $telefono === '') {
    header('Location: crear.php?error=' . urlencode('Completa los campos obligatorios.'));
    exit;
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: crear.php?error=' . urlencode('El correo electrónico no es válido.'));
    exit;
}

if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
    header('Location: crear.php?error=' . urlencode('Debes seleccionar una fotografía válida.'));
    exit;
}

if ($_FILES['foto']['size'] > 2 * 1024 * 1024) {
    header('Location: crear.php?error=' . urlencode('La fotografía no debe superar los 2 MB.'));
    exit;
}

$finfo = new finfo(FILEINFO_MIME_TYPE);
$tipoMime = $finfo->file($_FILES['foto']['tmp_name']);

$tiposPermitidos = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png'
];

if (!isset($tiposPermitidos[$tipoMime]) || getimagesize($_FILES['foto']['tmp_name']) === false) {
    header('Location: crear.php?error=' . urlencode('La fotografía debe ser JPG o PNG válida.'));
    exit;
}

$extension = $tiposPermitidos[$tipoMime];
$nombreArchivo = bin2hex(random_bytes(16)) . '.' . $extension;

$directorio = __DIR__ . '/archivos/';

if (!is_dir($directorio)) {
    mkdir($directorio, 0755, true);
}

$rutaDestino = $directorio . $nombreArchivo;
$rutaFoto = 'archivos/' . $nombreArchivo;

if (!move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
    header('Location: crear.php?error=' . urlencode('No se pudo guardar la fotografía.'));
    exit;
}

try {
    $sql = "INSERT INTO contactos (
                nombre,
                apellido,
                telefono,
                foto,
                email,
                direccion,
                notas
            ) VALUES (
                :nombre,
                :apellido,
                :telefono,
                :foto,
                :email,
                :direccion,
                :notas
            )";

    $consulta = $pdo->prepare($sql);

    $consulta->execute([
        ':nombre' => $nombre,
        ':apellido' => $apellido,
        ':telefono' => $telefono,
        ':foto' => $rutaFoto,
        ':email' => $email !== '' ? $email : null,
        ':direccion' => $direccion !== '' ? $direccion : null,
        ':notas' => $notas !== '' ? $notas : null
    ]);

    header('Location: index.php');
    exit;

} catch (PDOException $e) {
    if (file_exists($rutaDestino)) {
        unlink($rutaDestino);
    }

    header('Location: crear.php?error=' . urlencode('No se pudo registrar el contacto.'));
    exit;
}