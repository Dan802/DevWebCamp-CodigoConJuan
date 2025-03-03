<h2 class="dashboard__heading"><?php echo $titulo;?></h2>

<main class="bloques">
    <div class="bloques__grid">
        <div class="bloque">
            <h3 class="bloque__heading">Últimos Registros</h3>

            <?php foreach($registros as $registro): ?>
                <div class="bloque__contenido">
                    <p class="bloque__texto">
                        <?php echo $registro->usuario->nombre . ' ' . $registro->usuario->apellido; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="bloque">
            <h3 class="bloque__heading">Ingresos</h3>

            <p class="bloque__texto--cantidad">$ <?php echo $ingresos; ?></p>
        </div>

        <div class="bloque">
            <h3 class="bloque__heading">Eventos con Menos lugares disponibles</h3>

            <?php foreach($menos_disponibles as $evento): ?>
                <div class="bloque__contenido">
                    <p class="bloque__texto">
                        <?php echo 'Disponibles: ' . $evento->disponibles . '&nbsp;&nbsp;&nbsp;&nbsp;' . $evento->nombre;?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="bloque">
            <h3 class="bloque__heading">Eventos con Mas lugares disponibles</h3>

            <?php foreach($mas_disponibles as $evento): ?>
                <div class="bloque__contenido">
                    <p class="bloque__texto">
                        <?php echo 'Disponibles: ' . $evento->disponibles . '&nbsp;&nbsp;&nbsp;&nbsp;' . $evento->nombre;?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>