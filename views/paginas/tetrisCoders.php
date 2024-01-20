<main class="TetrisCoders">
    <h2 class="TetrisCoders__heading"><?php echo $titulo; ?></h2>
    <p class="TetrisCoders__descripcion">
        Conoce todo sobre el tetris moderno y tetris clásico
    </p>

    <div class="TetrisCoders__grid">
        <div class="TetrisCoders__imagen" <?php aos_animacion(); ?>>
            <picture>
                <source srcset="build/img/sobre_TetrisCoders.avif" type="image/avif">
                <source srcset="build/img/sobre_TetrisCoders.webp" type="image/webp">
                <img loading="lazy" src="build/img/sobre_TetrisCoders.jpg" alt="Imagen TetrisCoders" width="200">
            </picture>
        </div>

        <div class="TetrisCoders__contenido" <?php aos_animacion(); ?>>
            <p class="TetrisCoders__texto">¡Hola a todos! Bienvenidos TetrisCoders, el evento más esperado del año para los streamers, gamers y fans. En esta conferencia, aprenderán de los mejores expertos, conocerán las últimas novedades y tendencias, y podrán interactuar con otros creadores de todo el mundo. También habrá sorteos, premios y sorpresas que no se pueden perder. Estamos muy emocionados de tenerlos aquí y esperamos que disfruten de esta experiencia única. ¡Gracias por su apoyo y que comience la diversión!</p>
        </div>
    </div>
</main>