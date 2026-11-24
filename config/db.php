<?php
$envPath = dirname(__DIR__) . '/.env';

if (!file_exists($envPath)) {
    throw new RuntimeException(
        'No se encontro el archivo de configuracion .env'
    );
}

$config = parse_ini_file($envPath);

if ($config === false) {
    throw new RuntimeException(
        'No se pudo leer el archivo .env'
    );
}

$host = $config['DB_HOST'];
$port = $config['DB_PORT'];
$dbname = $config['DB_NAME'];
$username = $config['DB_USER'];
$password = $config['DB_PASSWORD'];

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

$opciones = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

$pdo = new PDO(
    $dsn,
    $username,
    $password,
    $opciones
);