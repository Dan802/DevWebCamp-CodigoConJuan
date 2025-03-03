<main class="agenda">
    <h2 class="agenda__heading">Torneos & Conferencias</h2>
    <p class="agenda__descripcion">Conoce toda la programación aquí</p>

    <div class="eventos ">
        <h3 class="eventos__heading">&lt; Torneos/></h3>

        <?php if(isset($eventos['workshops_v'])): ?>
            <p class="eventos__fecha">Viernes 2 de Febreo</p>
            <div class="eventos__listado slider swiper">

                    <div class="swiper-wrapper">
                        <?php 
                            foreach ($eventos['workshops_v'] as $evento): 
                                include __DIR__ . '../../templates/evento.php'; 
                            endforeach;
                        ?>
                    </div><!-- swiper-wrapper -->

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>

            </div>
        <?php endif; ?>


        <?php if(isset($eventos['workshops_s'])): ?>
            <p class="eventos__fecha">Sábado 3 de Febrero</p>
            <div class="eventos__listado slider swiper">

                    <div class="swiper-wrapper">
                        <?php 
                            foreach ($eventos['workshops_s'] as $evento): 
                                include __DIR__ . '../../templates/evento.php'; 
                            endforeach;
                        ?>
                    </div><!-- swiper-wrapper -->

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>

            </div>
        <?php endif; ?>

        <?php if(isset($eventos['workshops_d'])): ?>
            <p class="eventos__fecha">Domingo 4 de Febrero</p>
            <div class="eventos__listado slider swiper">

                    <div class="swiper-wrapper">
                        <?php 
                            foreach ($eventos['workshops_d'] as $evento): 
                                include __DIR__ . '../../templates/evento.php'; 
                            endforeach;
                        ?>
                    </div><!-- swiper-wrapper -->

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>

            </div>
        <?php endif; ?>
    </div>

    <div class="eventos eventos--torneos">
        <h3 class="eventos__heading">&lt; Conferencias /></h3>

        <?php if(isset($eventos['conferencias_v'])): ?>
            <p class="eventos__fecha">Viernes 2 de Febrero</p>
            <div class="eventos__listado slider swiper">

                <div class="swiper-wrapper">
                    <?php 
                        foreach ($eventos['conferencias_v'] as $evento): 
                            include __DIR__ . '../../templates/evento.php'; 
                        endforeach;
                    ?>
                </div><!-- swiper-wrapper -->

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

            </div><!-- slider -->
        <?php endif; ?>


        <?php if(isset($eventos['conferencias_s'])): ?>
            <p class="eventos__fecha">Sábado 3 de Febrero</p>
            <div class="eventos__listado slider swiper">

                <div class="swiper-wrapper">
                    <?php 
                        foreach ($eventos['conferencias_s'] as $evento): 
                            include __DIR__ . '../../templates/evento.php'; 
                        endforeach;
                    ?>
                </div><!-- swiper-wrapper -->

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

            </div>
        <?php endif; ?>

        <?php if(isset($eventos['conferencias_d'])): ?>
            <p class="eventos__fecha">Domingo 4 de Febrero</p>
            <div class="eventos__listado slider swiper">

                <div class="swiper-wrapper">
                    <?php 
                        foreach ($eventos['conferencias_d'] as $evento): 
                            include __DIR__ . '../../templates/evento.php'; 
                        endforeach;
                    ?>
                </div><!-- swiper-wrapper -->

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

            </div>
        <?php endif; ?>
    </div>

    
</main>