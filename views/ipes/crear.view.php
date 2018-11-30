<?php include 'views/header.php';?>
<div class="main">
    <div class="form">
        <h1 class="form__title">IPES</h1>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">    
            <!--ID Nombre Institucion-->
            <div class="form__item">
                <label for="idnombreinstitucion" class="form__input-label">ID Nombre Institucion</label>
                <input type="number" name="idnombreinstitucion" class="form__input-box">
            </div>
            <!--ID Campus-->
            <div class="form__item">
                <label for="idcampus" class="form__input-label">ID Campus</label>
                <input type="number" name="idcampus" class="form__input-box">
            </div>
            <!--Nombre-->
            <div class="form__item">
                <label for="nombre" class="form__input-label">Nombre</label>
                <input type="text" name="nombre" class="form__input-box">
            </div>
            <!--Entidad Federativa-->
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
    </div>
</div>
<?php include 'views/footer.php';?>