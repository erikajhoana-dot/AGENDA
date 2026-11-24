<?php include __DIR__."/includes/header.php";?>
<?php include __DIR__."/includes/menu.php";?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css">
    <title>Eliminar Contacto</title>
</head>
<body>

    <div id="nuevo-contacto">
        <img src="assets/images/eliminar-contacto.png" alt="Eliminar contacto">
        <div class="Info-sec">
            <h1>Eliminar contacto</h1>
            <p>Confirma si deseas eliminar un contacto de tu agenda</p>
        </div>
    </div>

    <main>

        <form action="" method="POST">

            <div id="columna1-crear">
                <img src="assets/images/eliminar.png" alt="Eliminar contacto">
                <p>Eliminar contacto</p>
            </div>

            <div id="columna2-crear">
    
                <label for="id">ID del contacto</label>
                <input type="number" id="id" name="id" required>
            </div>

            <div id="botones-crear">
                <a href="index.php">Cancelar</a>
                <button type="submit">Eliminar contacto</button>
            </div>

        </form>

    </main>

</body>
</html>

