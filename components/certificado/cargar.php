<?php
    $idalumno = 0;
    $calificaciones = array();
    
    $xml = simplexml_load_file($xmlroot);

    require $database;
    //conexion a base de datos
    $alumnodatos = $conexion->query('SELECT * FROM alumnos ORDER BY idalumno DESC');
    //creando datos
    

    /* foreach($alumnodatos as $filas) {
        //Igualar campos ALUMNO del XML a los de la base de datos
        $xml->Alumno['numeroControl'] = $filas['numerocontrol'];
        $xml->Alumno['curp'] = $filas['curp'];
        $xml->Alumno['nombre'] = $filas['nombre'];
        $xml->Alumno['primerApellido'] = $filas['appaterno'];
        $xml->Alumno['segundoApellido'] = $filas['apmaterno'];
        $xml->Alumno['idGenero'] = $filas['idgenero'];
        $xml->Alumno['fechaNacimiento'] = $filas['fechanacimiento'];
        $idalumno = $filas['idalumno'];
    }
    //Obtener asignaturas del alumno
    $asignaturasdatos = $conexion->prepare('SELECT * FROM asignaturas_alumno WHERE idalumno = :id');
    $asignaturasdatos->execute(array(':id' => $idalumno));
    $asignaturas = $asignaturasdatos->fetchAll();
    //crear nodo hijo de la etiqueta Asignaturas y añadirle los datos

    foreach($asignaturas as $asignatura) {
        $newasignatura = $xml->Asignaturas->addChild('Asignatura');
        $newasignatura->addAttribute('idAsignatura',$asignatura['idasignatura']);
        $newasignatura->addAttribute('ciclo',$asignatura['ciclo']);
        $newasignatura->addAttribute('calificacion',$asignatura['calificacion']);
        $newasignatura->addAttribute('idObservaciones',$asignatura['observaciones']);
        array_push($calificaciones, $asignatura['calificacion']);
    }

    $xml->Asignaturas['total'] = count($asignaturas);
    $xml->Asignaturas['asignadas'] = count($asignaturas);
    $xml->Asignaturas['promedio'] = array_sum($calificaciones) / count($asignaturas);

    //guardando XML
    $xml->asXML($xmlsaveroot); */
    //XML guardado
    echo "<a href='xmls/alumno.xml'>Ver Certificado</a>";
?>