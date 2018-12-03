
<?php
    session_start();
    $baseroot = 'C:/laragon/www/sistema_certificados/';
    $xmlroot = $baseroot . 'xmls/base.xml';
    $xmlsaveroot = $baseroot . 'xmls/alumno.xml';
    $database = $baseroot . 'components/database.php';

    include "components/certificado/cargar.php";

?>
