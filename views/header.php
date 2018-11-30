<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Gestion de certificados</title>
</head>
<body>
    <nav class="navbar">
        <ul class="navbar__list">
            <li class="navbar__item"><a href="index.php" class="navbar__link">Inicio</a></li>
            <?php 
                if (isset($_SESSION['usuario'])):
            ?>
                <li class="navbar__item"><a href="alumnos.php" class="navbar__link">Alumnos</a></li>
                <li class="navbar__item"><a href="asignaturas.php" class="navbar__link">Asignaturas</a></li>
                <li class="navbar__item"><a href="carreras.php" class="navbar__link">Carreras</a></li>
                <li class="navbar__item"><a href="certificados.php" class="navbar__link">Certificados</a></li>
                <li class="navbar__item"><a href="close.php" class="navbar__link">Cerrar sesion</a></li>
                <li class="navbar__item"><a href="ipes.php" class="navbar__link">IPES</a></li>
            <?php else: ?>
                <li class="navbar__item"><a href="login.php" class="navbar__link">login</a></li>
                <li class="navbar__item"><a href="register.php" class="navbar__link">register</a></li>
            <?php endif ?>
        </ul>
    </nav>