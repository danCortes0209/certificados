<?php
    require $database;

    $statement = $conexion->query('SELECT * FROM asignaturas');
    $statement->execute();
    $asignaturas = $statement->fetchAll();

    $statement = $conexion->query('SELECT * FROM alumnos');
    $statement->execute();
    $alumnos = $statement->fetchAll();

    require $baseroot.'views/asignaturas/cargaralumno.view.php';
?>