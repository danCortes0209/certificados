<?php 
    require $database;

    if (isset($_SESSION['usuario'])) {
        header('Location: index.php');
    }

    $errorcase = array(
        'userexist' => '<li style="color:grey;">Ya existe un responsable con los mismos datos ingresados</li>',
        'emptycase' => '<li style="color:grey;">Por favor rellena todos los datos correctamente</li>'
    );

    $errores = '';
    //obten IPES automaticamente para el SELECT
    $ipes = $conexion->prepare('SELECT * FROM ipes');
    $ipes->execute();
    $showipes = $ipes->fetchAll();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //obten datos de posr
        $curp = filter_var($_POST['curp'], FILTER_SANITIZE_STRING);
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $appaterno = filter_var($_POST['appaterno'], FILTER_SANITIZE_STRING);
        $apmaterno = filter_var($_POST['apmaterno'], FILTER_SANITIZE_STRING);
        $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
        $contraseña = filter_var($_POST['contra'], FILTER_SANITIZE_STRING);
        $cargo = $_POST['idcargo'];
        $idipes = $_POST['ipes'];

        if( empty($curp) or empty($nombre) or empty($apmaterno) or empty($appaterno) or empty($usuario) or empty($contraseña) or empty($cargo) or empty($idipes)) {
            $errores .= $errorcase['emptycase'];
        } else {
            $statement = $conexion->prepare('SELECT * FROM responsable WHERE curp = :curp');
            $statement->execute(array(':curp' => $curp));
            $resultado = $statement->fetch();

            if($resultado) {
                $errores .= $errorcase['userexist'];
            } else {
                $insert = $conexion->prepare('INSERT INTO responsable VALUES (NULL, :ips, :curp, :nom, :patern, :matern, :contra, :user, :carg)');
                $insert->execute(array(':ips' => $idipes, ':curp' => $curp, ':nom' => $nombre, ':patern' => $appaterno, ':matern' => $apmaterno, ':contra' => $contraseña, ':user' => $usuario, ':carg' => $cargo));
                header('Location: login.php');
            }
        }
    }

    require $baseroot.'views/sesion/register.view.php';
?>