<?php

// Crear conexión con la BD
require('../config/conexion.php');

// Consulta para obtener todos los bibliotecarios y los roles correspondientes
$queryBibliotecarios = "SELECT b.*, r.nombre as rol_nombre 
                        FROM bibliotecario b
                        JOIN rol r ON b.rol = r.identificador";

// Ejecutar la consulta
$resultadoBibliotecarios = mysqli_query($conn, $queryBibliotecarios);

// Verificar si hay errores en la consulta
if (!$resultadoBibliotecarios) {
    die("Error en la consulta: " . mysqli_error($conn));
}

// Verificar si hay bibliotecarios
if ($resultadoBibliotecarios && mysqli_num_rows($resultadoBibliotecarios) > 0):
?>

<!-- MOSTRAR LA TABLA -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Nombre Completo</th>
                <th scope="col" class="text-center">Documento de Identificación</th>
                <th scope="col" class="text-center">Turno de Trabajo</th>
                <th scope="col" class="text-center">Salario</th>
                <th scope="col" class="text-center">Rol</th>
            </tr>
        </thead>

        <tbody>

            <?php while ($fila = mysqli_fetch_assoc($resultadoBibliotecarios)): ?>

            <!-- Fila que se generará -->
            <tr>
                <td class="text-center"><?= htmlspecialchars($fila["nombre_completo"]); ?></td>
                <td class="text-center"><?= htmlspecialchars($fila["documento_de_identificacion"]); ?></td>
                <td class="text-center"><?= htmlspecialchars($fila["turno_trabajo"]); ?></td>
                <td class="text-center"><?= htmlspecialchars($fila["salario"]); ?></td>
                <td class="text-center">ID: <?= htmlspecialchars($fila["rol"]); ?> (<?= htmlspecialchars($fila["rol_nombre"]); ?>)</td>
            </tr>

            <?php endwhile; ?>

        </tbody>

    </table>
</div>

<?php
else:
    echo "<div class='alert alert-warning mt-5'>No hay bibliotecarios registrados.</div>";
endif;
?>