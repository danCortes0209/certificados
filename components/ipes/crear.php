<?php 

    require $database;

    $errorcase = array(
        'ipesexist' => '<li style="color:grey;">Ya existe una institucion con los mismos datos ingresados</li>',
        'emptycase' => '<li style="color:grey;">Por favor rellena todos los datos correctamente</li>'
    );

    $errores = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idnombreinstitucion = $_POST['idnombreinstitucion'];
        $idcampus = $_POST['idcampus'];
        $entidad = $_POST['entidad'];
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);

        if(empty($idnombreinstitucion) or empty($idcampus) or empty($entidad) or empty($nombre)) {
            $errores .= $errorcase['emptycase'];
        } else {
            $statement = $conexion->prepare('SELECT * FROM ipes WHERE idnombreinstitucion = :idnombr');
            $statement->execute(array(':idnombr' => $idnombreinstitucion));
            $resultado = $statement->fetch();

            if ($resultado) {
                $errores .= $errorcase['ipesexist'];
            } else {
                $statement = $conexion->prepare('INSERT INTO ipes (idnombreinstitucion, idcampus, identidadfederativa, nombre) VALUES (:nombrinst, :campus, :entidad, :nomb)');
                $statement->execute(array(':nombrinst' => $idnombreinstitucion, ':campus' => $idcampus, ':entidad' => $entidad, ':nomb' => $nombre));
            }
        }
    }

    require $baseroot.'views/ipes/crear.view.php';
?>