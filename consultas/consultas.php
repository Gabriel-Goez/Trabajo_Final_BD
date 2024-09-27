<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Consultas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<?php
include "../includes/header.php";
?>

<div class="container mt-5">
    <!-- Consulta 1 -->
    <h2>Consulta 1</h2>
    <p>Debe mostrar el documento de identificación y el nombre de los bibliotecarios que más ejemplares recibieron, y en caso de empate deberá mostrar a todos los bibliotecarios que empataron.</p>
    <form action="consulta1.php" method="get">
        <button type="submit" class="btn btn-primary">Ejecutar Consulta 1</button>
    </form>

    <hr>

    <!-- Consulta 2 -->
    <h2>Consulta 2</h2>
    <p>Esta consulta muestra el identificador, nombre de los tres roles que tienen mayor suma de páginas revisadas por bibliotecarios, y la cantidad de páginas revisadas por cada rol. En caso de empate, se mostrarán los roles que empataron.</p>
    <form action="consulta2.php" method="get">
        <button type="submit" class="btn btn-primary">Ejecutar Consulta 2</button>
    </form>
</div>

</body>
</html>