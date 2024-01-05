<?php 
    include_once __DIR__ . '/conferencias.php';
?>

<section class="resumen">
    <div class="resumen__grid">
        <div class="resumen__bloque" data-aos="fade-right">
            <p class="resumen__texto resumen__texto--numero"><?php echo $influencers_total; ?></p>
            <p class="resumen__texto">Speakers</p>
        </div>

        <div class="resumen__bloque" data-aos="fade-left">
            <p class="resumen__texto resumen__texto--numero"><?php echo $conferencias_total; ?></p>
            <p class="resumen__texto">Conferencias</p>
        </div>

        <div class="resumen__bloque" data-aos="fade-right">
            <p class="resumen__texto resumen__texto--numero"><?php echo $workshops_total; ?></p>
            <p class="resumen__texto">Workshops</p>
        </div>

        <div class="resumen__bloque" data-aos="fade-left">
            <p class="resumen__texto resumen__texto--numero">13</p>
            <p class="resumen__texto">Asistentes</p>
        </div>
    </div>
</section>


<section class="speakers">
    <h2 class="speakers__heading">Speakers</h2>
    <p class="speakers__descripcion">Conoce a nuestros expertos de DevWebCamp</p>

    <div class="speakers__grid">
        <?php foreach($influencers as $influencer): ?>

            <div class="speaker" <?php aos_animacion() ?>>
                <picture >
                    <source srcset="img/speakers/<?php echo $influencer->image; ?>.webp" type="image/webp">
                    <source srcset="img/speakers/<?php echo $influencer->image; ?>.png" type="image/png">
                    <img class="speaker__imagen-autor" loading="lazy" height="300" alt="Imagen Ponente"
                    src="img/speakers/<?php echo $influencer->image; ?>.png" >
                </picture>

                <div class="speaker__informacion">
                    <h4 class="speaker__nombre"><?php echo $influencer->firstName . ' ' . $influencer->lastName; ?></h4>

                    <p class="speaker__ubicacion"><?php echo $influencer->city . ', ' . $influencer->country; ?></p>

                    <nav class="speaker-sociales">
                        <?php $redes = json_decode($influencer->redes); ?>

                        <?php if(!empty($redes->facebook)): ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->facebook; ?>">
                                <span class="speaker-sociales__ocultar">Facebook</span>
                            </a> 
                        <?php endif; ?>

                        <?php if(!empty($redes->twitter)): ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->twitter; ?>">
                                <span class="speaker-sociales__ocultar">Twitter</span>
                            </a> 
                        <?php endif; ?>

                        <?php if(!empty($redes->youtube)): ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->youtube; ?>">
                                <span class="speaker-sociales__ocultar">YouTube</span>
                            </a> 
                        <?php endif; ?>

                        <?php if(!empty($redes->instagram)): ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->instagram; ?>">
                                <span class="speaker-sociales__ocultar">Instagram</span>
                            </a> 
                        <?php endif; ?>

                        <?php if(!empty($redes->tiktok)): ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->tiktok; ?>">
                                <span class="speaker-sociales__ocultar">Tiktok</span>
                            </a> 
                        <?php endif; ?>

                        <?php if(!empty($redes->github)): ?>
                            <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->github; ?>">
                                <span class="speaker-sociales__ocultar">Github</span>
                            </a>
                        <?php endif; ?>
                    </nav>

                    <ul class="speaker__listado-skills">
                        <?php $tags = explode(',', $influencer->tags); ?>

                        <?php foreach($tags as $tag): ?>
                            <li class="speaker__skill"><?php echo $tag; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<div id="mapa" class="mapa"></div>

<section class="boletos">
    <h2 class="boletos__heading">Boletos & Precios</h2>
    <p class="boletos__descripcion">Precios para DevWebCamp</p>

    <div class="boletos__grid" <?php aos_animacion() ?>>
        <div class="boleto boleto--presencial">
            <h4 class="boleto__logo">&#60;DevWebCamp /></h4>
            <p class="boleto__plan">Presencial</p>
            <p class="boleto__precio">$199</p>
        </div>

        <div class="boleto boleto--virtual" <?php aos_animacion() ?>>
            <h4 class="boleto__logo">&#60;DevWebCamp /></h4>
            <p class="boleto__plan">Virtual</p>
            <p class="boleto__precio">$159</p>
        </div>

        <div class="boleto boleto--gratis" <?php aos_animacion() ?>>
            <h4 class="boleto__logo">&#60;DevWebCamp /></h4>
            <p class="boleto__plan">Gratis</p>
            <p class="boleto__precio">Gratis - $0</p>
        </div>
    </div>

    <div class="boleto__enlace-contenedor">
        <a href="/paquetes" class="boleto__enlace">Ver Paquetes</a>
    </div>
</section>

