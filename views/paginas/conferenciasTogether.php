<main class="agenda">
    <h2 class="agenda__heading">Torneos & Conferencias</h2>
    <p class="agenda__descripcion">Conoce toda la programación aquí</p>

    <div class="eventos ">
        <h3 class="eventos__heading">&lt; Torneos/></h3>

        <div class="eventos__listado slider swiper">

                <div class="swiper-wrapper">
                    <?php 

                        if(isset($eventos['workshops_v'])):
                            foreach ($eventos['workshops_v'] as $evento): 
                                include __DIR__ . '../../templates/evento_date.php'; 
                            endforeach;
                        endif;

                        if(isset($eventos['workshops_s'])):
                            foreach ($eventos['workshops_s'] as $evento): 
                                include __DIR__ . '../../templates/evento_date.php'; 
                            endforeach;
                        endif;

                        if(isset($eventos['workshops_s'])):
                            foreach ($eventos['workshops_d'] as $evento): 
                                include __DIR__ . '../../templates/evento_date.php'; 
                            endforeach;
                        endif;
                    ?>
                </div><!-- swiper-wrapper -->

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

            </div><!-- slider -->
    </div>

    <div class="eventos eventos--torneos">
        <h3 class="eventos__heading">&lt; Conferencias /></h3>

        
            <div class="eventos__listado slider swiper">

                <div class="swiper-wrapper">
                    <?php 

                        if(isset($eventos['conferencias_v'])):
                            foreach ($eventos['conferencias_v'] as $evento): 
                                include __DIR__ . '../../templates/evento_date.php'; 
                            endforeach;
                        endif;

                        if(isset($eventos['conferencias_s'])):
                            foreach ($eventos['conferencias_s'] as $evento): 
                                include __DIR__ . '../../templates/evento_date.php'; 
                            endforeach;
                        endif;

                        if(isset($eventos['conferencias_s'])):
                            foreach ($eventos['conferencias_d'] as $evento): 
                                include __DIR__ . '../../templates/evento_date.php'; 
                            endforeach;
                        endif;
                    ?>
                </div><!-- swiper-wrapper -->

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

            </div><!-- slider -->
    </div>

    
</main>