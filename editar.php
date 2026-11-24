<?php include __DIR__."/includes/menu.php";?>
<?php include __DIR__."/includes/header.php";?>

<?php

$id = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
    <title>Editar Contacto</title>
</head>
<body>

<h1>Editar Contacto</h1>

<form action="actualizar.php" method="POST">

    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" required>
    <br><br>

    <label>Apellido:</label><br>
    <input type="text" name="apellido" required>
    <br><br>

    <label>Teléfono:</label><br>
    <input type="text" name="telefono" required>
    <br><br>

    <label>Email:</label><br>
    <input type="email" name="email">
    <br><br>

    <label>Dirección:</label><br>
    <input type="text" name="direccion">
    <br><br>

    <label>Notas:</label><br>
    <textarea name="notas"></textarea>
    <br><br>

    <button type="submit">Actualizar</button>

</form>

</body>
</html>
