<main class="auth">
    <h2 class="auth__encabezado"><?php echo $titulo; ?></h2>
    <p class="auth__descripcion">Inicia sesión en DevWebcamp</p>

    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <form method="POST" action="/login" class="formulario">
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input
                name="email"
                class="formulario__input"
                placeholder="Tu email"
                type="email"
                id="email"
            />
        </div>

        <div class="formulario__campo">
            <label for="password" class="formulario__label">Contraseña</label>
            <input
                name="password"
                class="formulario__input"
                placeholder="Tu contraseña"
                type="password"
                id="password"
            />
        </div>

        <input type="submit" class="formulario__submit" value="Iniciar sesión">
    </form>

    <div class="acciones">
        <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Crea una ahora</a>
        <a href="/olvide" class="acciones__enlace">¿Has olvidado tu contraseña?</a>
    </div>
</main>