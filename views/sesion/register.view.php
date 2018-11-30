<?php include 'views/header.php';?>
<div class="main">
    <div class="form">
        <h1 class="form__title">Registrar un Responsable</h1>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
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
            <!--Cargo-->
            <div class="form__item">
                <label for="idcargo" class="form__input-label">Cargo</label>
                <select name="idcargo" id="genero" class="form__select">
                    <option value="">Seleccione...</option>
                    <option value="1">DIRECTOR</option>
                    <option value="2">SUBDIRECTOR</option>
                    <option value="3">RECTOR</option>
                    <option value="4">VICERRECTOR</option>
                    <option value="5">RESPONSABLE DE EXPEDICIÓN </option>
                </select>
            </div>
            <!--Usuario-->
            <div class="form__item">
                <label for="usuario" class="form__input-label">Nombre de usuario</label>
                <input type="text" name="usuario" class="form__input-box">
            </div>
            <!--Contraseña-->
            <div class="form__item">
                <label for="contra" class="form__input-label">Contraseña</label>
                <input type="password" name="contra" class="form__input-box">
            </div>
            <!--IPES-->
            <div class="form__item">
                <label for="ipes" class="form__input-label">Institucion</label>
                <select name="ipes" id="ipes" class="form__select">
                    <option value="">Seleccione...</option>
                    <?php 
                        foreach($showipes as $ipe) {
                            echo '<option value="'.$ipe['idipes'].'">'.$ipe['nombre'].'</option>';
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
<?php include 'views/footer.php';?>