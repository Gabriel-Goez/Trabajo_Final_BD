<?php
require "../config/conexion.php"; // Conectar a la base de datos

// Capturar los datos enviados por el formulario
$identificador = $_POST['identificador'];
$estado = $_POST['estado'];
$edicion = $_POST['edicion'];
$formato = $_POST['formato'];
$idioma = $_POST['idioma'];
$isbn = $_POST['isbn'];
$editorial = $_POST['editorial'];
$numero_de_paginas = $_POST['numero_de_paginas'];
$fecha_de_ingreso = $_POST['fecha_de_ingreso'];
$receptor = $_POST['receptor'];
$revisor = !empty($_POST['revisor']) ? $_POST['revisor'] : NULL; // Si no hay revisor, se deja como NULL

// Consulta SQL para insertar los datos
$query = "INSERT INTO ejemplar (identificador, estado, edicion, formato, idioma, isbn, editorial, numero_de_paginas, fecha_de_ingreso, receptor, revisor)
          VALUES ('$identificador', '$estado', '$edicion', '$formato', '$idioma', '$isbn', '$editorial', '$numero_de_paginas', '$fecha_de_ingreso', '$receptor', NULLIF('$revisor', ''))";

// Ejecutar la consulta
if (mysqli_query($conn, $query)) {
    echo "Ejemplar insertado correctamente.";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn); // Cerrar la conexión
?>