<<?php include __DIR__."/includes/menu.php";?>
<?php include __DIR__."/includes/header.php";?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Eliminar contacto</title>
</head>
<body>

    <h1>Eliminar Contacto</h1>

    <p>¿Está seguro de que desea eliminar este contacto?</p>

    <form action="" method="POST">

        <label>ID del contacto:</label><br>
        <input type="number" name="id" required>

        <br><br>

        <button type="submit">Eliminar</button>

    </form>

</body>
</html>
