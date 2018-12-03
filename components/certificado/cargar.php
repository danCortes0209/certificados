<?php
    require $database;

    $errorcase = array(
        'userexist' => '<li style="color:grey;">Ya existe un alumno con los mismos datos ingresados</li>',
        'emptycase' => '<li style="color:grey;">Por favor seleccione un alumno y rellene los datos correctamente</li>',
        'nostudent' => '<li style="color:grey;">Es necesario contar con alumnos registrados</li>',
        'noasigns' => '<li style="color:grey;">Es necesario que el alumno tenga Asignaturas registradas</li>',
        'rvoeexist' => '<li style="color:grey;">Ya existe un RVOE con ese numero</li>'
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
        date_default_timezone_set('America/Mexico_City');
        $date = date('Y-m-d H:i:s');
        $idalumno = $_POST['alumno'];
        $tipocertificacion = $_POST['tipocertificacion'];
        $folio = $_POST['foliocontrol'];
        $sello = $_POST['sello'];
        $certresp = $_POST['certificadoresponsable'];
        $nocertresp = $_POST['nocertificadoresponsable'];
        $rvoe = $_POST['numrvoe'];
        $entidad = $_POST['entidad'];
        
        if (empty($idalumno) or empty($tipocertificacion) or empty($folio) or empty($sello) or empty($certresp) or empty($nocertresp) or empty($rvoe) or empty($entidad)) {
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

                //obtener datos del mismo certificado
                $getcert = $conexion->prepare('SELECT * FROM certificado WHERE idalumno = :idal AND foliocontrol = :folio');
                $getcert->execute(array(':idal'=> $idalumno, ':folio' => $folio));
                $existcert = $getcert->fetch();
                if ($existcert) {
                    cargarCertificadoXML($existcert, $xml, $xmlsaveroot);
                    cargarRvoeToDatabaseAndXML($existcert['idcertificado'],$rvoe, $date, $conexion, $xml, $xmlsaveroot);
                    crearExpedicionXML($existcert['idcertificado'],$tipocertificacion, $entidad , $date, $conexion, $xml, $xmlsaveroot);
                } else {
                    //insertar el certificado en la base de datos
                    $crearcert = $conexion->prepare('INSERT INTO certificado VALUES (null, :tip, :folio, :sello, :certresp, :nocertresp, :resp, :alum)');
                    $crearcert->execute(array(':tip' => $tipocertificacion, ':folio' => $folio, ':sello' => $sello, ':certresp' => $certresp, ':nocertresp' => $nocertresp, ':resp' =>  $responsable['idresponsable'], ':alum' => $idalumno));
                    
                    $getcertif = $conexion->prepare('SELECT * FROM certificado WHERE idalumno = :idal AND foliocontrol = :folio');
                    $getcertif->execute(array(':idal'=> $idalumno, ':folio' => $folio));
                    $existcertif = $getcertif->fetch();
                    cargarCertificadoXML($existcertif, $xml, $xmlsaveroot); 
                    cargarRvoeToDatabaseAndXML($existcertif['idcertificado'], $rvoe, $date, $conexion, $xml, $xmlsaveroot);
                    crearExpedicionXML($existcertif['idcertificado'],$tipocertificacion, $entidad , $date, $conexion, $xml, $xmlsaveroot);
                }
                //mostrar XML
                $certificado .="<a href='xmls/alumno.xml'>Ver Certificado</a>";
            } else {
                $errores .= $errorcase['nostudent'];
            }
        }
    }

    function cargarCertificadoXML($certif, $archivo, $ruta) {
        $archivo['folioControl'] = $certif['foliocontrol'];
        $archivo['sello'] = $certif['sello'];
        $archivo['certificadoResponsable'] = $certif['certresp'];
        $archivo['noCertificadoResponsable'] = $certif['nocertresp'];
        $archivo->asXML($ruta);
    }

    function cargarRvoeToDatabaseAndXML($certid, $norvoe, $fecha, $conecc, $archivo, $ruta) {
        $archivo->Rvoe['numero'] = $norvoe;
        $archivo->Rvoe['fechaExpedicion'] = $fecha;
        $archivo->asXML($ruta);
        //buscar rvoe
        $state = $conecc->prepare('SELECT * FROM rvoe WHERE numero = :num');
        $state->execute(array(':num' => $norvoe));
        $existrvoe = $state->fetch();

        if(!$existrvoe)  {
            $state = $conecc->prepare('INSERT INTO rvoe VALUES (NULL, :num, :fec, :cer)');
            $state->execute(array(':num' => $norvoe, ':fec' => $fecha, ':cer' => $certid));
        }
    }

    function crearExpedicionXML($certid,$tipo,$estado, $fecha, $conecc, $archivo, $ruta){
        $archivo->Expedicion['idTipoCertificacion'] = $tipo;
        $archivo->Expedicion['idLugarExpedicion'] = $estado;
        $archivo->Expedicion['fecha'] = $fecha;
        $archivo->asXML($ruta);
        //buscar rvoe
        $state = $conecc->prepare('INSERT INTO expedicion VALUES (Null, :tip, :fec, :ent, :cer)');
        $state->execute(array(':tip' => $tipo,':fec' => $fecha,':ent' => $estado, ':cer' => $certid));
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