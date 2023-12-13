<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo;?></h2>
    <p class="auth__texto">Coloca tu nueva contraseña</p>


    <?php require_once __DIR__ . '/../templates/alertas.php'; ?>

    <?php if($token_valido): ?>
        <form action="" method="POST" class="formulario">
            <div class="formulario__campo">
                <label for="password" class="formulario__label">Nueva Contraseña</label>
                <input type="password" 
                        name="password" 
                        id="password" 
                        placeholder="Contraseña Nueva"
                        class="formulario__input">
            </div>

            <input type="submit" class="formulario__submit" value="Enviar Correo">
        </form>
    <?php endif; ?>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Inicia Sesión</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? ¡Regístrate!</a>
    </div>
</main>