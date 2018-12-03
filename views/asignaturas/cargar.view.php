<?php include 'views/header.php';?>
<!--Pagina principal-->
<div class="main">
    <div class="form">
        <h1 class="form__title">Crear Asignaturas</h1>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <!--Nombre-->
            <div class="form__item">
                <label for="nombre" class="form__input-label">Nombre(s)</label>
                <input type="text" placeholder="Nombre(s)" class="form__input-box" name="nombre">
            </div>
            <!--Descripcion-->
            <div class="form__item">
                <label for="descripcion" class="form__input-label">Descripcion</label>
                <input type="text" placeholder="Descripcion corta" class="form__input-box" name="descripcion">
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