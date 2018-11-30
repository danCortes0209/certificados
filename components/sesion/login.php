<?php 
    
    require $database;
    
    if (isset($_SESSION['usuario'])) {
        header('Location: index.php'); 
    }

    $errorcase = array(
        'baduser' => '<li style="color:grey;">Datos Incorrectos</li>',
        'emptycase' => '<li style="color:grey;">Por favor rellena todos los datos correctamente</li>'
    );

    $errores = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $passwd = filter_var($_POST['contra'], FILTER_SANITIZE_STRING);
        $name = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);

        if (empty($passwd) or empty($name)) {
            $errores .= $errorcase['emptycase'];
        } else {
            $statement = $conexion->prepare('SELECT * FROM responsable WHERE contraseña = :passwd AND usuario = :nam');
            $statement->execute(array(':passwd' => $passwd, ':nam' => $name  )); 
            $resultado = $statement->fetch();
             if ($resultado) { 
                $_SESSION['usuario'] = $name;
                header("location:index.php"); 
            } else { 
                $_SESSION['usuario'] = $name;
                $errores .= $errorcase['baduser'];
                header("location:index.php"); 
            } 
        }
    }
    require $baseroot.'views/sesion/login.view.php';
?>