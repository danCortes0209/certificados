<?php
    require $database;

    $errorcase = array(
        'userexist' => '<li style="color:grey;">Ya existe un alumno con los mismos datos ingresados</li>',
        'emptycase' => '<li style="color:grey;">Por favor rellena todos los datos correctamente</li>'
    );

    $errores = '';
    //obten carreras automaticamente para el SELECT
    $carreras = $conexion->prepare('SELECT * FROM carreras');
    $carreras->execute();
    $showcarreras = $carreras->fetchAll();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //obten datos de posr
        $numcontrol = filter_var($_POST['numerocontrol'], FILTER_SANITIZE_STRING);
        $curp = filter_var($_POST['curp'], FILTER_SANITIZE_STRING);
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $appaterno = filter_var($_POST['appaterno'], FILTER_SANITIZE_STRING);
        $apmaterno = filter_var($_POST['apmaterno'], FILTER_SANITIZE_STRING);
        $idgenero = $_POST['idgenero'];
        $fechanacimiento = filter_var($_POST['fechanacimiento'], FILTER_SANITIZE_STRING);
        $carrera = $_POST['carrera'];
        $periodo = $_POST['periodo'];

        //Si algun dato está vacio
        if(empty($numcontrol) or empty($curp) or empty($nombre) or empty($appaterno) or empty($apmaterno) or empty ($idgenero) or empty($fechanacimiento) or empty($carrera) or empty($periodo)) {
            $errores .= $errorcase['emptycase'];
        } else {
            //si no, busca entre los alumnos
            $statement = $conexion->prepare('SELECT * FROM alumnos WHERE numerocontrol = :num OR curp = :curp LIMIT 1');
		    $statement->execute(array(':num' => $numcontrol, ':curp' => $curp));
            $resultado = $statement->fetch();
            
            if ($resultado == false) { 
                //si no estaba registrado, lo registra
                $statement = $conexion->prepare('INSERT INTO alumnos (numerocontrol,fechanacimiento,curp,nombre,appaterno,apmaterno,idgenero) VALUES (:numc,:fechanac,:curp,:nomb,:appat,:apmat,:idgen)');
                $statement->execute(array(':numc' => $numcontrol,':fechanac' => $fechanacimiento ,':curp' => $curp ,':nomb'=>$nombre ,':appat' => $appaterno,':apmat' => $apmaterno ,':idgen' => $idgenero ));
                //obtiene su ID
                $statement = $conexion->prepare('SELECT * FROM alumnos WHERE numerocontrol = :numc');
                $statement->execute(array(':numc' => $numcontrol));
                $resultado = $statement->fetch();
                $idalumno = $resultado[0];
                //lo registra dentro de un plan de carrera
                date_default_timezone_set('America/Mexico_City');
                $statement2 = $conexion->prepare('INSERT INTO plancarrera (idcarrera,claveplan,idtipoperiodo,idalumno) VALUES (:carrera,:clave,:periodo,:alumno)');
                $statement2->execute(array(':carrera'=>$carrera, ':clave' => date('Y'), ':periodo' => $periodo, ':alumno' => $idalumno));
            } else {
                //de estar registrado, manda ese error
                $errores .= $errorcase['userexist'];
            } 
        }
    }

    require $baseroot.'views/alumnos/crear.view.php';
?>