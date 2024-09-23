<main class="auth">
    <h2 class="auth__encabezado"><?php echo $titulo; ?></h2>
    <p class="auth__descripcion">Tu cuenta de DevWebCam</p>

    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <?php
        if ( isset($alertas['exito'])) { ?>

        <div class="acciones--centrar">
            <a href="/login" class="acciones__enlace">Iniciar sesión</a>
        </div>

    <?php }; ?>
</main>