<?php include 'views/header.php';?>
<div class="main">
    <div class="form">
        <h1 class="form__title">Generar Certificado</h1>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            
            <!--Carreras-->
            <div class="form__item">
                <label for="alumno" class="form__input-label">Alumno (will display an ID on selection)</label>
                <input type="text" name="alumno" list="alumno" class="form__input-box">
                <datalist id="alumno" class="form__select">
                    <option value="">Seleccione...</option>
                    <?php 
                        foreach($showalumnos as $alumno) {
                            echo '<option value="'.$alumno['idalumno'].'">'.$alumno['numerocontrol'].'</option>';
                        }
                    ?>    
                </datalist>
            </div>
            <!--Tipo Certificacion-->
            <div class="form__item">
                <label for="tipocertificacion" class="form__input-label">Tipo de certificacion</label>
                <select name="tipocertificacion" id="tipocertificacion" class="form__select">
                    <option value="">Seleccione...</option>
                    <option value="79">Total</option>
                    <option value="80">Parcial</option>    
                </select>
            </div>
            <!--Folio de control-->
            <div class="form__item">
                <label for="foliocontrol" class="form__input-label">Folio de control</label>
                <input type="text" placeholder="Folio de control" class="form__input-box" name="foliocontrol">
            </div>
            <!--Sello-->
            <div class="form__item">
                <label for="sello" class="form__input-label">Sello</label>
                <input type="text" placeholder="Sello" class="form__input-box" name="sello">
            </div>
            <!--Certificado Responsable-->
            <div class="form__item">
                <label for="certificadoresponsable" class="form__input-label">Certificado Responsable</label>
                <input type="text" placeholder="Certificado Responsable" class="form__input-box" name="certificadoresponsable">
            </div>
            <!--No. Certificado Responsable-->
            <div class="form__item">
                <label for="nocertificadoresponsable" class="form__input-label">No. Certificado Responsable</label>
                <input type="text" placeholder="No. Certificado Responsable" class="form__input-box" name="nocertificadoresponsable">
            </div>
            <!--Numero de RVOE-->
            <div class="form__item">
                <label for="numrvoe" class="form__input-label">Numero de RVOE</label>
                <input type="text" placeholder="numero de RVOE" class="form__input-box" name="numrvoe">
            </div>
            <!--Entidad federativa-->
            <div class="form__item">
                <?php include 'views/utils/entidad.select.php'; ?>
            </div>
            <!--Envio-->
            <input type="submit" value="Enviar" class="form__submit">
        </form>
        <?php if (!empty($errores)): ?>
            <!--Si errores no esta vacia, entonces añade este div con el contenido de errores, la cual sera un li-->
            <div style="font-size: 0-7em;">
                <ul style="list-style: none;">
                    <?php echo $errores; ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php 
            if(!empty($certificado)){
                echo $certificado;
            }
        ?>

    </div>
</div>
<?php include 'views/footer.php';?>