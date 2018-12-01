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