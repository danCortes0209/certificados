<?php
    require $database;

    $errorcase = array(
        'carexist' => '<li style="color:grey;">Ya existe una carrera con estos datos</li>',
        'emptycase' => '<li style="color:grey;">Por favor rellena todos los datos correctamente</li>'
    );

    $errores = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        if (empty($nombre) or empty($descripcion)) {
            $errores .= $errorcase['emptycase'];
        } else {
            $statement = $conexion->prepare('SELECT * FROM carreras WHERE nombre = :nom');
            $statement->execute(array(':nom' => $nombre));
            $existencia = $statement->fetch();

            if($existencia) {
                //de estar registrado, manda ese error
                $errores .= $errorcase['carexist'];
            } else {
                $statement = $conexion->prepare('INSERT INTO carreras VALUES (NULL, :nom, :descri)');
                $statement->execute(array(':nom' => $nombre, ':descri' => $descripcion));
            }
        }

    }

    require $baseroot.'views/carreras/cargar.view.php';
?>