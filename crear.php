<?php include __DIR__."/includes/menu.php";?>
<?php include __DIR__."/includes/header.php";?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
    <title>Crear Contacto</title>
</head>
<body>


    <div id="nuevo-contacto">
        <img src="assets/images/boton-mas.png" alt="Agregar foto">
        <div class="Info-sec">
            <h1>Crear nuevo contacto</h1>
            <p>Completa el formulario para agregar un nuevo contacto</p>
        </div>
    </div>

    <form action="guardar.php" method="POST" enctype="multipart/form-data">

        <div id="columna1-crear">
            <button type="sumit">Seleccionar foto</button>
            <p>Formatos: JPG, PNG<br>Obligatorio</p>
        </div>

        <div id="columna2-crear">
            <label>Nombre</label><br>
            <input type="text" name="nombre" required>
            <br><br>

            <label>Apellido</label><br>
            <input type="text" name="apellido" required>
            <br><br>

            <label>Teléfono</label><br>
            <input type="text" name="telefono" required>
            <br><br>

            <label>Email(opcional)</label><br>
            <input type="email" name="email">
            <br><br>
        </div>

        <div id="columna3-crear">
            <label>Dirección (opcional)</label>
            <input type="text" name="direccion">
            
            <label>Notas (opcional)</label>
            <textarea name="notas"></textarea>
        </div>

        <div id="botones-crear">
            <button type="button">Cancelar</button>
            <button type="submit">Guardar Contacto</button>
        </div>

    </form>

</body>
</html>
