<?php include 'views/header.php';?>
<!--Pagina principal-->
<div class="main">
    <div class="form">
        <h1 class="form__title">Asignar materias del alumno</h1>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <!--Carreras-->
            <div class="form__item">
                <label for="asignatura" class="form__input-label">Asignaturas</label>
                <select name="asignatura" id="asignatura" class="form__select">
                    <option value="">Seleccione...</option>
                    <?php 
                        foreach($asignaturas as $carrera) {
                            echo '<option value="'.$carrera['idasignatura'].'">'.$carrera['nombre'].'</option>';
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
                            echo '<option value="'.$alumno['idalumno'].'">'.$alumno['numerocontrol'].'</option>';
                        }
                    ?>    
                </select>
            </div>
            <!--Ciclo-->
            <div class="form__item">
                <label for="ciclo" class="form__input-label">Ciclo</label>
                <input type="text" class="form__input-box" placeholder="AAAA-Q" name="ciclo">
            </div>
            <!--Calificacion-->
            <div class="form__item">
                <label for="calificacion" class="form__input-label">Calificacion</label>
                <input type="number" class="form__input-box" name="calificacion" min="1" max="10" step=".1">
            </div>
            <!--Observaciones-->
            <div class="form__item">
                <label for="observaciones" class="form__input-label">Observaciones</label>
                <select name="observaciones" id="observaciones" class="form__select">
                    <option value="">Seleccione...</option>
                    <option value="70">EQUIVALENCIA DE ESTUDIOS</option>
                    <option value="71">EXAMEN EXTRAORDINARIO</option>
                    <option value="72">EXAMEN A TITULO DE SUFICIENCIA</option>
                    <option value="73">CURSO DE VERANO</option>
                    <option value="74">RECURSAMIENTO</option>
                    <option value="75">REINGRESO</option>
                    <option value="76">ACUERDO REGULARIZACIÓN</option>
                    <option value="77">CON CAMBIO EN EL ACUERDO DE RVOE</option>
                    <option value="78">REVALIDACIÓN DE ESTUDIOS</option>
                    <option value="100">NORMAL / ORDINARIO</option>
                    <option value="101">CORRESPONDENCIA DE ASIGNATURA POR PLAN</option>
                    <option value="102">EXENTO</option>
                    <option value="103">ACREDITADO O APROBADO</option>
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