<?php
include "../includes/header.php";
?>

<h1 class="mt-3">Consulta 2</h1>

<p class="mt-3">
    Esta consulta muestra el identificador, nombre de los tres roles que tienen 
    mayor suma de páginas revisadas por bibliotecarios y la cantidad de páginas
    revisadas por cada rol. En caso de empate, se mostrarán los roles que empataron.
</p>

<?php
// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL para obtener los 3 roles con mayor suma de páginas revisadas
$query = "
WITH PaginasRevisadas AS (
    SELECT 
        r.identificador,
        r.nombre,
        SUM(e.numero_de_paginas) AS total_paginas
    FROM 
        rol r
    LEFT JOIN 
        bibliotecario b ON r.identificador = b.rol
    LEFT JOIN 
        ejemplar e ON b.documento_de_identificacion = e.revisor
    GROUP BY 
        r.identificador, r.nombre
),
RolesRanked AS (
    SELECT 
        identificador,
        nombre,
        total_paginas,
        DENSE_RANK() OVER (ORDER BY total_paginas DESC) AS ranking
    FROM 
        PaginasRevisadas
)

SELECT 
    identificador, 
    nombre, 
    total_paginas
FROM 
    RolesRanked
WHERE 
    ranking <= 3
ORDER BY
    total_paginas DESC;";

// Ejecutar la consulta
$resultadoC2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);
?>

<?php
// Verificar si llegan datos
if($resultadoC2 and $resultadoC2->num_rows > 0):
?>
<div class="container mt-3">
    <!-- Botón de flecha hacia la izquierda -->
    <button onclick="window.history.back();" class="btn btn-secondary btn-sm">
        &larr; Volver
    </button>
    <div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="text-center">Identificador</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Total Páginas Revisadas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Iterar sobre los registros que llegaron
                foreach ($resultadoC2 as $fila):
                ?>
                <tr>
                    <td class="text-center"><?= $fila["identificador"]; ?></td>
                    <td class="text-center"><?= $fila["nombre"]; ?></td>
                    <td class="text-center"><?= $fila["total_paginas"]; ?></td>
                </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php else: ?>

<div class="alert alert-danger text-center mt-5">
    No se encontraron resultados para esta consulta
</div>

<?php endif; ?>

<?php
include "../includes/footer.php";
?>
