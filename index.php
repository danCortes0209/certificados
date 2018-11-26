<?php include 'views/header.php';?>
<!--Pagina principal-->
<div class="main">
    <?php
        $baseroot = 'C:/laragon/www/sistema_certificados/';
        $xmlroot = $baseroot . 'xmls/base.xml';
        $xmlsaveroot = $baseroot . 'xmls/alumno.xml';
        $database = $baseroot . 'components/database.php';

        include "components/alumnos/ver.php";

    ?>
</div>
<!--Termina Pagina Principal-->
<?php include 'views/footer.php';?>