<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identificador = $_POST['identificador'];
    $nombre = $_POST['nombre'];

    // Validar que el identificador no tenga más de 4 dígitos
    if ($identificador > 9999) {
        // Redirigir al usuario con un mensaje de error
        header("Location: rol.php?error=digits");
        exit(); // Detener la ejecución del script
    }

    // Consulta para insertar datos
    $query = "INSERT INTO rol (identificador, nombre) VALUES ('$identificador', '$nombre')";

    // Ejecutar consulta
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    // Redirigir al usuario a la misma página (rol.php)
    if ($result) {
        header("Location: rol.php?success=1");
    } else {
        header("Location: rol.php?error=1");
    }

    // Cerrar la conexión
    mysqli_close($conn);
}
?>