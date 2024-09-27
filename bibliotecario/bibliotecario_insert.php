<?php

// Crear conexión con la BD
require('../config/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_completo = $_POST['nombre_completo'];
    $documento_de_identificacion = $_POST['documento_de_identificacion'];
    $turno_trabajo = $_POST['turno_trabajo'];
    $salario = $_POST['salario'];
    $rol = $_POST['rol'];

    // Consulta para insertar datos en la tabla bibliotecario
    $query = "INSERT INTO bibliotecario (nombre_completo, documento_de_identificacion, turno_trabajo, salario, rol) 
              VALUES ('$nombre_completo', '$documento_de_identificacion', '$turno_trabajo', '$salario', '$rol')";

    // Ejecutar consulta
    $result = mysqli_query($conn, $query);

    // Redirigir al usuario
    if ($result) {
        header("Location: bibliotecario.php?success=1");
    } else {
        header("Location: bibliotecario.php?error=1");
    }


    // Cerrar conexión
    mysqli_close($conn);
}
?>