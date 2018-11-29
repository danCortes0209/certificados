<?php
    require $database;

    $calificaciones = array();
    $errorcase = array(
        'userexist' => '<li style="color:grey;">Ya existe un alumno con los mismos datos ingresados</li>',
        'emptycase' => '<li style="color:grey;">Por favor seleccione un alumno</li>'
    );
    $errores = '';

    $xml = simplexml_load_file($xmlroot);

    //conexion a base de datos
    $alumnodatos = $conexion->query('SELECT numerocontrol, idalumno  FROM alumnos ORDER BY numerocontrol');
    $alumnodatos->execute();
    $showalumnos = $alumnodatos->fetchAll();
    //creando datos
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idalumno = $_POST['alumno'];
        
        if (empty($idalumno)) {
            $errores .= $errorcase['emptycase'];
        } else {
            $alumnodatos = $conexion->prepare('SELECT * FROM alumnos, plancarrera WHERE alumnos.idalumno = :idalumno AND alumnos.idalumno = plancarrera.idalumno ');
            $alumnodatos->execute(array(':idalumno'=>$idalumno));
            //Cargar datos del alumno al XML
            $resultado = $alumnodatos->fetch();
            cargarAlumnoXML($resultado, $xml, $xmlsaveroot);
            cargarCarreraXML($resultado, $xml, $xmlsaveroot);
            
            echo "<a href='xmls/alumno.xml'>Ver Certificado</a>";
        }

        
    }

    function cargarAlumnoXML($alumno, $archivo, $ruta) {
        $archivo->Alumno['numeroControl'] = $alumno['numerocontrol'];
        $archivo->Alumno['curp'] = $alumno['curp'];
        $archivo->Alumno['nombre'] = $alumno['nombre'];
        $archivo->Alumno['primerApellido'] = $alumno['appaterno'];
        $archivo->Alumno['segundoApellido'] = $alumno['apmaterno'];
        $archivo->Alumno['idGenero'] = $alumno['idgenero'];
        $archivo->Alumno['fechaNacimiento'] = $alumno['fechanacimiento'];
        $archivo->asXML($ruta);
    }

    function cargarCarreraXML($alumno, $archivo, $ruta) {
        $archivo->Carrera['idCarrera'] = $alumno['idcarrera'];
        $archivo->Carrera['idTipoPeriodo'] = $alumno['idtipoperiodo'];
        $archivo->Carrera['clavePlan'] = $alumno['claveplan'];
        $archivo->asXML($ruta);
    }
    /* 
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
    //;

    require $baseroot.'views/certificados/cargar.view.php';
?>