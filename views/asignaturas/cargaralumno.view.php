<?php include 'views/header.php';?>
<!--Pagina principal-->
<div class="main">
    <div class="form">
        <h1 class="form__title">Crear un Alumno</h1>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <!--Carreras-->
            <div class="form__item">
                <label for="asignaturas" class="form__input-label">Asignaturas</label>
                <select name="asignaturas" id="asignaturas" class="form__select">
                    <option value="">Seleccione...</option>
                    <?php 
                        foreach($asignaturas as $carrera) {
                            echo '<option value="'.$carrera['idcarrera'].'">'.$carrera['nombre'].'</option>';
                        }
                    ?>    
                </select>
            </div>
            <!--Alumnos-->
            <div class="form__item">
                <label for="alumno" class="form__input-label">Alumnos</label>
                <select name="alumno" id="alumno" class="form__select">
                    <option value="">Seleccione...</option>
                    <?php 
                        foreach($alumnos as $alumno) {
                            echo '<option value="'.$alumno['idcarrera'].'">'.$alumno['numerocontrol'].'</option>';
                        }
                    ?>    
                </select>
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
    </div>
</div>
<!--Termina Pagina Principal-->
<?php include 'views/footer.php';?>