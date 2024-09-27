<?php
require "../config/conexion.php"; // Conectar a la base de datos

// Consulta para obtener los ejemplares
$queryEjemplares = "SELECT * FROM ejemplar";
$resultadoEjemplares = mysqli_query($conn, $queryEjemplares);
// Verificar si hay errores en la consulta
if (!$resultadoEjemplares) {
    die("Error en la consulta: " . mysqli_error($conn));
}

// Verificar si hay bibliotecarios
if ($resultadoEjemplares && mysqli_num_rows($resultadoEjemplares) > 0):
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Ejemplares</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">
    <p class = 'h2'>Listado de Ejemplares</p>
    <table class="table table-striped table-bordered">
        <thead class = "table-dark">
            <tr>
                <th scope="col" class="text-center">Identificador</th>
                <th scope="col" class="text-center">Estado</th>
                <th scope="col" class="text-center">Edición</th>
                <th scope="col" class="text-center">Formato</th>
                <th scope="col" class="text-center">Idioma</th>
                <th scope="col" class="text-center">ISBN</th>
                <th scope="col" class="text-center">Editorial</th>
                <th scope="col" class="text-center">Número de Páginas</th>
                <th scope="col" class="text-center">Fecha de Ingreso</th>
                <th scope="col" class="text-center">Receptor</th>
                <th scope="col" class="text-center">Revisor</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysqli_fetch_assoc($resultadoEjemplares)): ?>
            <tr>
                <td class="text-center"><?= htmlspecialchars($fila['identificador']); ?></td>
                <td class="text-center"><?= htmlspecialchars($fila['estado']); ?></td>
                <td class="text-center"><?= htmlspecialchars($fila['edicion']); ?></td>
                <td class="text-center"><?= htmlspecialchars($fila['formato']); ?></td>
                <td class="text-center"><?= htmlspecialchars($fila['idioma']); ?></td>
                <td class="text-center"><?= htmlspecialchars($fila['isbn']); ?></td>
                <td class="text-center"><?= htmlspecialchars($fila['editorial']); ?></td>
                <td class="text-center"><?= htmlspecialchars($fila['numero_de_paginas']); ?></td>
                <td class="text-center"><?= htmlspecialchars($fila['fecha_de_ingreso']); ?></td>
                <td class="text-center"><?= htmlspecialchars($fila['receptor']); ?></td>
                <td class="text-center"><?= htmlspecialchars($fila['revisor'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php mysqli_close($conn); // Cerrar la conexión ?>
<?php
else:
    echo "<div class='alert alert-warning mt-5'>No hay ejemplares registrados.</div>";
endif;
?>
</body>
</html>
