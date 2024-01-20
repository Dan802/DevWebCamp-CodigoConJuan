<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo;?></h2>
    <p class="auth__texto">Regístrate en TetrisCoders</p>

    <?php 
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <form action="/registro" method="POST" class="formulario">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input type="text" 
                    name="nombre" 
                    id="nombre" 
                    placeholder="Nombre Completo"
                    class="formulario__input"
                    value="<?php echo $usuario->nombre; ?>"> 
        </div>

        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input type="text" 
                    name="apellido" 
                    id="apellido" 
                    placeholder="Apellidos Completos"
                    class="formulario__input"
                    value="<?php echo $usuario->apellido; ?>">
        </div>
        
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Correo Electrónico</label>
            <input type="email" 
                    name="email" 
                    id="email" 
                    placeholder="Tu Correo Electrónico"
                    class="formulario__input"
                    value="<?php echo $usuario->email; ?>">
        </div>
        
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Contraseña</label>
            <input type="password" 
                    name="password" 
                    id="password" 
                    placeholder="Tu Contraseña"
                    class="formulario__input">
        </div>

        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Repetir contraseña</label>
            <input type="password" 
                    name="password2" 
                    id="password2" 
                    placeholder="Tu Contraseña"
                    class="formulario__input">
        </div>

        <input type="submit" class="formulario__submit" value="Crear Cuenta">
    </form>

    <div class="acciones">
        <a href="/registro" class="acciones__enlace">¿Ya tienes cuenta? Inicia Sesión!</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña?</a>
    </div>
</main>