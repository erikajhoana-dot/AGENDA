
<?php include __DIR__."/includes/header.php";?>
<?php include __DIR__."/includes/menu.php";?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css">
    <title>Mis Contactos</title>
</head>
<body>

    <div id="nuevo-contacto">
        <img src="assets/images/mis-contactos.png" alt="Contactos">
        <div class="Info-sec">
            <h1>Mis contactos</h1>
            <p>Consulta y administra los contactos guardados en tu agenda</p>
        </div>
    </div>

    <main>

        <div id="botones-crear">
            <a href="crear.php">Agregar contacto</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Fotografía</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <div id="botones-crear">
                            <a href="editar.php">Editar</a>
                            <a href="eliminar.php">Eliminar</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

    </main>

</body>
</html>

