<?php
include "../includes/header.php";
include "../config/conexion.php"; // Conexión a la base de datos

// Consulta para obtener los bibliotecarios existentes para el bibliotecario receptor y revisor
$queryBibliotecarios = "SELECT documento_de_identificacion, nombre_completo FROM bibliotecario";
$resultadoBibliotecarios = mysqli_query($conn, $queryBibliotecarios);

// Consulta para obtener todos los ejemplares existentes
$queryEjemplares = "SELECT * FROM ejemplar";
$resultadoEjemplares = mysqli_query($conn, $queryEjemplares);
?>

<!-- TÍTULO -->
<h1 class="mt-3">Entidad EJEMPLAR</h1>

<!-- MENSAJES DE ÉXITO O ERROR -->
<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success" role="alert">
        El ejemplar ha sido agregado exitosamente.
    </div>
<?php elseif (isset($_GET['error'])): ?>
    <div class="alert alert-danger" role="alert">
        Ocurrió un error al agregar el ejemplar. Por favor, intenta nuevamente.
    </div>
<?php endif; ?>

<!-- FORMULARIO DE INSERCIÓN DE EJEMPLARES -->
<div class="formulario p-4 m-3 border rounded-3">
    <form action="ejemplar_insert.php" method="POST" class="form-group">

        <!-- Campo Identificador -->
        <div class="mb-3">
            <label for="identificador" class="form-label">Identificador</label>
            <input type="number" class="form-control" name="identificador" id="identificador" required>
        </div>

        <!-- Campo Estado -->
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" name="estado" id="estado" required>
                <option value="">Seleccione un estado</option>
                <option value="Disponible">Disponible</option>
                <option value="No Disponible">No Disponible</option>
            </select>
        </div>

        <!-- Campo Edición -->
        <div class="mb-3">
            <label for="edicion" class="form-label">Edición</label>
            <input type="number" class="form-control" name="edicion" id="edicion" required>
        </div>

        <!-- Campo Formato -->
        <div class="mb-3">
            <label for="formato" class="form-label">Formato</label>
            <select class="form-select" name="formato" id="formato" required>
                <option value="">Seleccione un formato</option>
                <option value="Digital">Digital</option>
                <option value="Físico">Físico</option>
            </select>
        </div>

        <!-- Campo Idioma -->
        <div class="mb-3">
            <label for="idioma" class="form-label">Idioma</label>
            <input type="text" class="form-control" name="idioma" id="idioma" required>
        </div>

        <!-- Campo ISBN -->
        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" class="form-control" name="isbn" id="isbn" required>
        </div>

        <!-- Campo Editorial -->
        <div class="mb-3">
            <label for="editorial" class="form-label">Editorial</label>
            <input type="text" class="form-control" name="editorial" id="editorial" required>
        </div>

        <!-- Campo Número de Páginas -->
        <div class="mb-3">
            <label for="numero_de_paginas" class="form-label">Número de Páginas</label>
            <input type="number" class="form-control" name="numero_de_paginas" id="numero_de_paginas" required>
        </div>

        <!-- Campo Fecha de Ingreso -->
        <div class="mb-3">
            <label for="fecha_de_ingreso" class="form-label">Fecha de Ingreso</label>
            <input type="date" class="form-control" name="fecha_de_ingreso" id="fecha_de_ingreso" required>
        </div>

        <!-- Lista desplegable para el bibliotecario receptor (obligatorio) -->
        <div class="mb-3">
            <label for="receptor" class="form-label">Bibliotecario Receptor</label>
            <select class="form-select" name="receptor" id="receptor" required>
                <option value="">Seleccionar bibliotecario receptor</option>
                <?php while($fila = mysqli_fetch_assoc($resultadoBibliotecarios)): ?>
                    <option value="<?= htmlspecialchars($fila['documento_de_identificacion']); ?>">
                        <?= htmlspecialchars($fila['nombre_completo']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Lista desplegable para el bibliotecario revisor (opcional) -->
        <div class="mb-3">
            <label for="revisor" class="form-label">Bibliotecario Revisor (Opcional)</label>
            <select class="form-select" name="revisor" id="revisor">
                <option value="">Ninguno</option>
                <?php
                // Reiniciar el puntero de resultado para reutilizar la lista de bibliotecarios
                mysqli_data_seek($resultadoBibliotecarios, 0);
                while($fila = mysqli_fetch_assoc($resultadoBibliotecarios)): ?>
                    <option value="<?= htmlspecialchars($fila['documento_de_identificacion']); ?>">
                        <?= htmlspecialchars($fila['nombre_completo']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Botón para enviar -->
        <button type="submit" class="btn btn-primary">Insertar Ejemplar</button>

    </form>
</div>

<?php
require("ejemplar_select.php")
?>