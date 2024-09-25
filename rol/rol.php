<?php
include "../includes/header.php";
?>

<!-- TÍTULO -->
<h1 class="mt-3">Entidad ROL</h1>

<!-- MENSAJES DE ÉXITO O ERROR -->
<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success" role="alert">
        El rol ha sido agregado exitosamente.
    </div>
<?php elseif (isset($_GET['error'])): ?>
    <div class="alert alert-danger" role="alert">
        Ocurrió un error al agregar el rol. Por favor, intenta nuevamente.
    </div>
<?php endif; ?>

<!-- FORMULARIO -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="rol_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="identificador" class="form-label">Identificador (Máximo 4 dígitos)</label>
            <input type="number" class="form-control" id="identificador" name="identificador" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Lógica para mostrar la lista de roles existentes
require("rol_select.php");

// Verificar si hay resultados
if ($resultadoRol && $resultadoRol->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Identificador</th>
                <th scope="col" class="text-center">Nombre</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoRol as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <td class="text-center"><?= $fila["identificador"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
            </tr>

            <?php
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<?php
endif;

include "../includes/footer.php";
?>
