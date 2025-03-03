<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo;?></h2>
    <p class="auth__texto">Inicia Sesión en</p>

    <?php 
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <form action="/login" method="POST" class="formulario">
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Correo Electrónico</label>
            <input type="email" 
                    name="email" 
                    id="email" 
                    placeholder="Tu Correo Electrónico"
                    class="formulario__input">
        </div>
        
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Contraseña</label>
            <input type="password" 
                    name="password" 
                    id="password" 
                    placeholder="Tu Contraseña"
                    class="formulario__input">
        </div>

        <input type="submit" class="formulario__submit" value="Iniciar Sesión">
    </form>

    <div class="acciones">
        <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? ¡Regístrate!</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña?</a>
    </div>
</main>