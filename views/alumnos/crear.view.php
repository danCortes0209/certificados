<div class="form">
    <h1 class="form__title">Crear un Alumno</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <!--Matricula-->
        <div class="form__item">
            <label for="numerocontrol" class="form__input-label">Numero de control</label>
            <input type="text" placeholder="Matricula Universitaria" class="form__input-box" name="numerocontrol">
        </div>
        <!--CURP-->
        <div class="form__item">
            <label for="curp" class="form__input-label">CURP</label>
            <input type="text" placeholder="CURP del alumno" class="form__input-box" name="curp">
        </div>
        <!--Nombre-->
        <div class="form__item">
            <label for="nombre" class="form__input-label">Nombre(s)</label>
            <input type="text" placeholder="Nombre(s)" class="form__input-box" name="nombre">
        </div>
        <!--Apellido Paterno-->
        <div class="form__item">
            <label for="appaterno" class="form__input-label">Apellido Paterno</label>
            <input type="text" placeholder="Apellido Paterno" class="form__input-box" name="appaterno">
        </div>
        <!--Apellido Materno-->
        <div class="form__item">
            <label for="apmaterno" class="form__input-label">Apellido Materno</label>
            <input type="text" placeholder="Apellido Materno" class="form__input-box" name="apmaterno">
        </div>
        <!--Genero-->
        <div class="form__item">
            <label for="idgenero" class="form__input-label">Genero</label>
            <select name="idgenero" id="genero" class="form__select">
                <option value="">Seleccione...</option>
                <option value="250">Femenino</option>
                <option value="251">Masculino</option>    
            </select>
        </div>
        <!--Fecha Nacimiento-->
        <div class="form__item">
            <label for="fechanacimiento" class="form__input-label">Fecha de Nacimiento</label>
            <input type="text" class="form__input-box" placeholder="AAAA-MM-DD" name="fechanacimiento">
        </div>
        <!--Carreras-->
        <div class="form__item">
            <label for="carrera" class="form__input-label">Carrera</label>
            <select name="carrera" id="carrera" class="form__select">
                <option value="">Seleccione...</option>
                <?php 
                    foreach($showcarreras as $carrera) {
                        echo '<option value="'.$carrera['idcarrera'].'">'.$carrera['nombre'].'</option>';
                    }
                ?>    
            </select>
        </div>
        <!--Periodo de la carrera-->
        <div class="form__item">
            <label for="periodo" class="form__input-label">Periodo</label>
            <select name="periodo" id="periodo" class="form__select">
                <option value="">Seleccione...</option>
                <option value="91">Semestre</option>
                <option value="92">Bimestre</option>
                <option value="93">Cuatrimestre</option>
                <option value="94">Tetramestre</option>
                <option value="260">Trimestre</option>
                <option value="261">Modular</option>
                <option value="262">Anual</option>    
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