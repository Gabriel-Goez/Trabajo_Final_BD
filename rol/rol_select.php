<?php

// Crear conexión con la BD
require('../config/conexion.php');

// Consulta para obtener los roles
$query = "SELECT * FROM rol";

$resultadoRol = $conn->query($query);

if (!$resultadoRol) {
    echo "Error al obtener los roles: " . $conn->error;
}

// No cerrar la conexión aquí, ya que se usará más adelante
?>