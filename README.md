## Integrantes del equipo

- Erika Jhoana Hidalgo de la Torre
- Belem de Jesús Hernández Molina
- Juan Pablo Velázquez Rangel
- Karen Yamilet Domínguez Gómez

## Materia

Programación Web

## Descripción del proyecto

Este proyecto consiste en el desarrollo de una aplicación web para la gestión de una agenda de contactos. El sistema permite administrar información personal mediante operaciones de creación, consulta, actualización y eliminación de registros.

La aplicación cuenta con una interfaz que facilita la administración de los contactos, permitiendo almacenar información como nombre, apellido, teléfono, correo electrónico, dirección, notas y fotografía.

Además, permite consultar los detalles de cada contacto, modificar su información y actualizar su fotografía cuando sea necesario.

## Tecnologías utilizadas

- **PHP:** Lenguaje utilizado para desarrollar la lógica del servidor y procesar las operaciones del sistema.
- **MySQL:** Sistema gestor de bases de datos utilizado para almacenar y administrar la información de los contactos.
- **PDO (PHP Data Objects):** Utilizado para establecer la conexión con MySQL y ejecutar consultas preparadas de manera segura.
- **HTML5:** Para estructurar las páginas de la aplicación.
- **CSS3:** Para diseñar y dar estilo a la interfaz del sistema.

## Funcionalidades implementadas

El sistema cuenta con las siguientes funcionalidades:

### Crear contactos
- Registrar nuevos contactos.
- Guardar nombre, apellido, teléfono, correo electrónico, dirección y notas.
- Subir una fotografía para cada contacto.
- Validar los campos obligatorios.

### Consultar contactos
- Mostrar todos los contactos registrados en una tabla.
- Visualizar la fotografía, nombre, teléfono y correo electrónico de cada contacto.
- Consultar la información completa de un contacto desde su apartado de detalles.

### Actualizar contactos
- Modificar la información de los contactos existentes.
- Actualizar la fotografía de un contacto.
- Conservar la fotografía anterior cuando no se selecciona una nueva.

### Eliminar contactos
- Eliminar contactos registrados en el sistema.

## Operaciones CRUD

El proyecto implementa las cuatro operaciones principales de administración de datos:

- **Create (Crear):** Registrar nuevos contactos. 
- **Read (Consultar):** Consultar la lista y los detalles de los contactos. 
- **Update (Actualizar):** Modificar la información de los contactos. 
- **Delete (Eliminar):** Eliminar contactos de la agenda. 

## Conexión a la base de datos

La conexión con MySQL se realiza mediante PDO. Los datos de configuración se almacenan en un archivo `.env`, evitando colocar directamente las credenciales de la base de datos en el código fuente.

Las consultas que reciben datos del usuario utilizan consultas preparadas para mejorar la seguridad y prevenir ataques de inyección SQL.