<?php
    require $database;

    $errorcase = array(
        'userexist' => '<li style="color:grey;">Ya existe un alumno con los mismos datos ingresados</li>',
        'emptycase' => '<li style="color:grey;">Por favor seleccione un alumno</li>',
        'nostudent' => '<li style="color:grey;">Es necesario contar con alumnos registrados</li>',
        'noasigns' => '<li style="color:grey;">Es necesario que el alumno tenga Asignaturas registradas</li>'
    );
    $errores = '';
    $certificado = '';

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
            //buscar datos del alumno
            $alumnodatos = $conexion->prepare('SELECT * FROM alumnos, plancarrera WHERE alumnos.idalumno = :idalumno AND alumnos.idalumno = plancarrera.idalumno ');
            $alumnodatos->execute(array(':idalumno'=>$idalumno));
            $alumno = $alumnodatos->fetch();
            //buscar datos del responsable
            $responsabledata = $conexion->prepare('SELECT * FROM responsable WHERE usuario = :user');
            $responsabledata->execute(array(':user' => $_SESSION['usuario']));
            $responsable = $responsabledata->fetch();
            //validar que exista el responsable
            if ($alumno and $responsable) {
                //Cargar datos del alumno al XML si se encontró el alumno
                cargarAlumnoXML($alumno, $xml, $xmlsaveroot);
                cargarCarreraXML($alumno, $xml, $xmlsaveroot);
                cargarResponsableXML($responsable, $xml, $xmlsaveroot, $conexion);
                //Buscar las asignaturas del alumno
                $asignaturasdatos = $conexion->prepare('SELECT * FROM asignaturas_alumno WHERE idalumno = :id');
                $asignaturasdatos->execute(array(':id' => $idalumno));
                $asignaturas = $asignaturasdatos->fetchAll();
                //validar la existencia de asignaturas
                if($asignaturas) {
                    cargarAsignaturasXML($asignaturas, $xml, $xmlsaveroot);
                } else {
                    $errores .= $errorcase['noasigns'];
                }
                //mostrar XML
                $certificado .="<a href='xmls/alumno.xml'>Ver Certificado</a>";
            } else {
                $errores .= $errorcase['nostudent'];
            }
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

    function cargarAsignaturasXML($asigns, $archivo, $ruta) {
        $calificaciones = array();
        foreach($asigns as $asign) {
            $newasignatura = $archivo->Asignaturas->addChild('Asignatura');
            $newasignatura->addAttribute('idAsignatura',$asign['idasignatura']);
            $newasignatura->addAttribute('ciclo',$asign['ciclo']);
            $newasignatura->addAttribute('calificacion',$asign['calificacion']);
            $newasignatura->addAttribute('idObservaciones',$asign['observaciones']);
            array_push($calificaciones, $asign['calificacion']);
        }
        $archivo->Asignaturas['total'] = count($asigns);
        $archivo->Asignaturas['asignadas'] = count($asigns);
        $archivo->Asignaturas['promedio'] = array_sum($calificaciones) / count($asigns);
        $archivo->asXML($ruta);
    }

    function cargarResponsableXML($responsable, $archivo, $ruta, $conexion) {
        $archivo->Ipes->Responsable['nombre'] = $responsable['nombre'];
        $archivo->Ipes->Responsable['primerApellido'] = $responsable['appaterno'];
        $archivo->Ipes->Responsable['segundoApellido'] = $responsable['apmaterno'];
        $archivo->Ipes->Responsable['curp'] = $responsable['curp'];
        $archivo->Ipes->Responsable['idCargo'] = $responsable['idcargo'];

        $statement = $conexion->prepare('SELECT * FROM ipes WHERE idipes = :id');
        $statement->execute(array(':id' => $responsable['idipes']));
        $resultado = $statement->fetch();

        if ($resultado) {
            $archivo->Ipes['idNombreInstitucion'] = $resultado['idnombreinstitucion'];
            $archivo->Ipes['idCampus'] = $resultado['idcampus'];
            $archivo->Ipes['idEntidadFederativa'] = $resultado['identidadfederativa'];
            $archivo->asXML($ruta);
        } 
    }

    require $baseroot.'views/certificados/cargar.view.php';
?>