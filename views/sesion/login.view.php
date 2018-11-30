<?php include 'views/header.php';?>
<div class="main">
<div class="form">
        <h1 class="form__title">Inicio de sesion</h1>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
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