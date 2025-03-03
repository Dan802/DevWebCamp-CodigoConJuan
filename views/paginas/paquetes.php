<main class="paquetes">
    <h2 class="paquetes__heading"><?php echo $titulo; ?></h2>
    <p class="paquetes__descripcion">Compara los paquetes de TetrisCoders</p>

    <div class="paquetes__grid">
        <div class="paquete" <?php aos_animacion(); ?>>
            <h3 class="paquete__nombre">Pase Gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a TetrisCoders</li>
            </ul>

            <p class="paquete__precio">$0</p>
        </div>

        <div class="paquete" <?php aos_animacion(); ?>>
            <h3 class="paquete__nombre">Pase Presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Presencial a TetrisCoders</li>
                <li class="paquete__elemento">Pase por dos días</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
                <li class="paquete__elemento">Camisa del Evento</li>
                <li class="paquete__elemento">Comida y bebida</li>
            </ul>

            <p class="paquete__precio">$12</p>
        </div>

        <div class="paquete" <?php aos_animacion(); ?>>
            <h3 class="paquete__nombre">Pase Virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Pase por dos días</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
            </ul>

            <p class="paquete__precio">$5</p>
        </div>

        
    </div>
</main>