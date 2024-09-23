<main class="auth">
    <h2 class="auth__encabezado"><?php echo $titulo; ?></h2>
    <p class="auth__descripcion">Recupera tu acceso a DevWebcamp</p>

    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <form method="POST" action="/olvide" class="formulario">
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

        <input type="submit" class="formulario__submit" value="Enviar instrucciones">
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Iniciar sesión</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Crea una ahora</a>
    </div>
</main>