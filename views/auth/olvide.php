<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo;?></h2>
    <p class="auth__texto">Recupera tu acceso a TetrisCoders</p>

    <p>Te enviaremos un correo con los pasos para recuperar el acceso a tu cuenta.</p>

    <?php require_once __DIR__ . '/../templates/alertas.php'; ?>

    <form action="/olvide" method="POST" class="formulario">
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Correo Electrónico</label>
            <input type="email" 
                    name="email" 
                    id="email" 
                    placeholder="Tu Correo Electrónico"
                    class="formulario__input">
        </div>

        <input type="submit" class="formulario__submit" value="Enviar Correo">
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Inicia Sesión</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? ¡Regístrate!</a>
    </div>
</main>