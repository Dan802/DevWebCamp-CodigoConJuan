<header class="header">
    <div class="header__contenedor">
        <nav class="header__navegacion">

            <?php if(is_auth()): ?>
                <a class="header__enlace" href="<?php echo (is_admin2()) ? '/admin/dashboard' : '/finalizar-registro';?>">
                    <?php echo (is_admin2()) ? 'Administrar' : 'Finalizar Registro';?>
                </a>
                <form action="/logout" method="POST" class="header__form">
                <input type="submit"
                        value="Cerrar Sesión"
                        class="header__submit">
            </form>
            <?php else: ?>
                <a href="/registro" class="header__enlace">Registro</a>
                <a href="/login" class="header__enlace">Login</a>
            <?php endif; ?>

        </nav>

        <div class="contenido">
            <a href="/">
                <h1 class="header__logo">&#60; TetrisCoders /></h1>
            </a>

            <p class="header__texto">2 al 4 de febrero</p>
            <p class="header__texto header__texto--modalidad">En línea y Presencial</p>

            <a href="/registro" class="header__button">Comprar entrada</a>
        </div>
    </div>
</header>

<div class="barra">
    <div class="barra__contenido">
        <h2 class="barra__logo">&#60; TetrisCoders /></h2>

        <nav class="navegacion">
            <a href="/tetrisCoders" class="navegacion__enlace <?php echo pagina_actual('/tetrisCoders') ? 'navegacion__enlace--actual' : ''; ?>">Evento</a>
            <a href="/paquetes" class="navegacion__enlace <?php echo pagina_actual('/paquetes') ? 'navegacion__enlace--actual' : ''; ?>">Paquetes</a>
            <a href="/torneos-conferencias" class="navegacion__enlace <?php echo pagina_actual('/torneos-conferencias') ? 'navegacion__enlace--actual' : ''; ?>">Torneos & Conferencias</a>
            <a href="/registro" class="navegacion__enlace <?php echo pagina_actual('/registro') ? 'navegacion__enlace--actual' : ''; ?>">Comprar Entrada</a>
        </nav>
    </div>
</div>