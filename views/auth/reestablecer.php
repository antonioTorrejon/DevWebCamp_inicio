<main class="auth">
    <h2 class="auth__encabezado"><?php echo $titulo; ?></h2>
    <p class="auth__descripcion">Escribe tu nueva contraseña</p>

    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <?php if($token_valido) { ?>

    <form method="POST" class="formulario">
        <div class="formulario__campo">
            <label for="passwqord" class="formulario__label">Nueva contaseña</label>
            <input
                name="password"
                class="formulario__input"
                placeholder="Tu nueva contraseña"
                type="password"
                id="password"
            />
        </div>

        <input type="submit" class="formulario__submit" value="Guardar contraseña">
    </form>

    <?php } ?>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Iniciar sesión</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Crea una ahora</a>
    </div>
</main>