<?php
    require $database;

    $errorcase = array(
        'asignexist' => '<li style="color:grey;">Ya se ha asignado la materia a ese alumno</li>',
        'emptycase' => '<li style="color:grey;">Por favor rellena todos los datos correctamente</li>'
    );

    $errores = '';

    $statement = $conexion->query('SELECT * FROM asignaturas');
    $statement->execute();
    $asignaturas = $statement->fetchAll();

    $statement = $conexion->query('SELECT * FROM alumnos');
    $statement->execute();
    $alumnos = $statement->fetchAll();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $alumno = $_POST['alumno'];
        $asignatura = $_POST['asignatura'];
        $ciclo = $_POST['ciclo'];
        $calificacion = $_POST['calificacion'];
        $observaciones = $_POST['observaciones'];

        if(empty($alumno) or empty($asignatura) or empty($ciclo) or empty($calificacion) or empty($observaciones)) {
            $errores .= $errorcase['emptycase'];
        } else {
            $statement = $conexion->prepare('SELECT * FROM asignaturas_alumno WHERE idalumno = :alumno AND idasignatura = :asignatura');
            $statement->execute(array(':alumno' => $alumno, ':asignatura' => $asignatura));
            $existencia = $statement->fetch();

            if($existencia) {
                $errores .= $errorcase['asignexist'];
            } else {
                $statement = $conexion->prepare('INSERT INTO asignaturas_alumno VALUES (null, :alumn, :asign, :ciclo, :calif, :observ)');
                $statement->execute(array(':alumn' => $alumno, ':asign' => $asignatura, ':ciclo' => $ciclo, ':calif' => $calificacion, ':observ' => $observaciones));
            }
        }
    }

    require $baseroot.'views/asignaturas/cargaralumno.view.php';
?>