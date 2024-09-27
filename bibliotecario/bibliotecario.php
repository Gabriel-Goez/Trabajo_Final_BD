<?php
include "../includes/header.php";
include "../config/conexion.php"; // Conexión a la base de datos

// Obtener los roles disponibles
$queryRoles = "SELECT identificador, nombre FROM rol";
$resultadoRoles = mysqli_query($conn, $queryRoles);
?>

<!-- TÍTULO -->
<h1 class="mt-3">Entidad BIBLIOTECARIO</h1>

<!-- MENSAJES DE ÉXITO O ERROR -->
<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success" role="alert">
        El bibliotecario ha sido agregado exitosamente.
    </div>
<?php elseif (isset($_GET['error'])): ?>
    <div class="alert alert-danger" role="alert">
        Ocurrió un error al agregar el bibliotecario. Por favor, intenta nuevamente.
    </div>
<?php endif; ?>

<!-- FORMULARIO -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="bibliotecario_insert.php" method="post" class="form-group" onsubmit="return validarFormulario()">

        <div class="mb-3">
            <label for="nombre_completo" class="form-label">Nombre Completo</label>
            <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" required>
        </div>

        <div class="mb-3">
            <label for="documento_de_identificacion" class="form-label">Documento de Identificación</label>
            <input type="number" class="form-control" id="documento_de_identificacion" name="documento_de_identificacion" min="10000000" required>
        </div>

        <div class="mb-3">
            <label for="turno_trabajo" class="form-label">Turno de Trabajo</label>
            <select class="form-select" id="turno_trabajo" name="turno_trabajo" required>
                <option value="Mañana">Mañana</option>
                <option value="Tarde">Tarde</option>
                <option value="Noche">Noche</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="salario" class="form-label">Salario</label>
            <input type="number" class="form-control" id="salario" name="salario" step="0.01" required>
        </div>

        <!-- Selección de Rol -->
        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select class="form-select" id="rol" name="rol" required>
                <option value="">Seleccione un rol</option>
                <?php while ($fila = mysqli_fetch_assoc($resultadoRoles)): ?>
                    <option value="<?= $fila['identificador']; ?>">
                        <?= $fila['nombre']; ?> (ID: <?= $fila['identificador']; ?>)
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agregar Bibliotecario</button>

    </form>
    
</div>

<script>
// Validar formulario antes de enviarlo (agrega validaciones según sea necesario)
function validarFormulario() {
    // Validación básica de campos
    return true; // Puedes agregar más validaciones si es necesario
}
</script>

<?php
// Incluir el archivo que contiene la lógica de selección de bibliotecarios
require("bibliotecario_select.php");
?>