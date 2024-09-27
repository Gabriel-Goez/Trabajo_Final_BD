<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda 2</h1>

<p class="mt-3">
    Ingrese el identificador de un rol para obtener el bibliotecario
    con dicho rol de mayor salario (desempate por menor cédula), y
    todos los datos de cada ejemplar que revisó.
</p>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a esta mismo archivo -->
    <form action="busqueda2.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="numero1" class="form-label">Rol</label>
            <input type="number" class="form-control" id="numero1" name="numero1" required>
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>

    </form>
    
</div>

<?php
// Dado que el action apunta a este mismo archivo, hay que hacer eata verificación antes
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Crear conexión con la BD
    require('../config/conexion.php');

    $numero1 = $_POST["numero1"];

    // Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
    $query = "SELECT e.*
              FROM bibliotecario b1 JOIN ejemplar e
              ON b1.documento_de_identificacion = e.revisor
              WHERE rol = ".$numero1." AND
                salario IN (SELECT MAX(salario)
                            FROM (SELECT *
                                  FROM bibliotecario
                                  WHERE rol = ".$numero1.") b2
                                  ) AND
                                        NOT EXISTS (SELECT *
                                                    FROM (SELECT *
                                                          FROM bibliotecario
                                                          WHERE rol = ".$numero1.") b4
                                                    WHERE b4.documento_de_identificacion < b1.documento_de_identificacion);";

    // Ejecutar la consulta
    $resultadoB2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if($resultadoB2 and $resultadoB2->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">identificador</th>
                <th scope="col" class="text-center">estado</th>
                <th scope="col" class="text-center">edicion</th>
                <th scope="col" class="text-center">formato</th>
                <th scope="col" class="text-center">idioma</th>
                <th scope="col" class="text-center">isbn</th>
                <th scope="col" class="text-center">editorial</th>
                <th scope="col" class="text-center">revisor</th>
                <th scope="col" class="text-center">receptor</th>
                <th scope="col" class="text-center">numero_de_paginas</th>
                <th scope="col" class="text-center">fecha_de_ingreso</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoB2 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["identificador"]; ?></td>
                <td class="text-center"><?= $fila["estado"]; ?></td>
                <td class="text-center"><?= $fila["edicion"]; ?></td>
                <td class="text-center"><?= $fila["formato"]; ?></td>
                <td class="text-center"><?= $fila["idioma"]; ?></td>
                <td class="text-center"><?= $fila["isbn"]; ?></td>
                <td class="text-center"><?= $fila["editorial"]; ?></td>
                <td class="text-center"><?= $fila["revisor"]; ?></td>
                <td class="text-center"><?= $fila["receptor"]; ?></td>
                <td class="text-center"><?= $fila["numero_de_paginas"]; ?></td>
                <td class="text-center"><?= $fila["fecha_de_ingreso"]; ?></td>
            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<!-- Mensaje de error si no hay resultados -->
<?php
else:
?>

<div class="alert alert-danger text-center mt-5">
    No se encontraron resultados para esta consulta
</div>

<?php
    endif;
endif;

include "../includes/footer.php";
?>