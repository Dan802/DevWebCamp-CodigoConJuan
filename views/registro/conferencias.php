<h2 class="pagina__heading"><?php echo $titulo; ?></h2>
<p class="pagina__descripcion">Elije hasta 5 eventos para asistir de forma presencial.</p>

<div class="eventos-registro">
    <main class="eventos-registro__listado">
    
        <h3 class="eventos-registro__heading">&lt; Conferencias /></h3>

        <?php if(isset($eventos['conferencias_v']) &&  sizeof($eventos['conferencias_v']) > 0 ):?>
            <p class="eventos-registro__fecha">Viernes 2 de Febreo</p>
            <div class="eventos-registro__grid">
                <?php 
                    foreach ($eventos['conferencias_v'] as $evento): 
                        include __DIR__ . '/evento.php'; 
                    endforeach;
                    ?>
            </div>
        <?php endif; ?>

        <?php if(isset($eventos['conferencias_s']) &&  sizeof($eventos['conferencias_s']) > 0 ):?>
            <p class="eventos-registro__fecha">Sábado 3 de Febreo</p>
            <div class="eventos-registro__grid">
                <?php 
                    foreach ($eventos['conferencias_s'] as $evento): 
                        include __DIR__ . '/evento.php'; 
                    endforeach;
                ?>
            </div>
        <?php endif; ?>

        <?php if(isset($eventos['conferencias_d']) &&  sizeof($eventos['conferencias_d']) > 0 ):?>
            <p class="eventos-registro__fecha">Domingo 4 de Febreo</p>
            <div class="eventos-registro__grid">
                <?php 
                    foreach ($eventos['conferencias_d'] as $evento): 
                        include __DIR__ . '/evento.php'; 
                    endforeach;
                ?>
            </div>
        <?php endif; ?>

        <h3 class="eventos-registro__heading">&lt; Torneos/></h3>

        <?php if(isset($eventos['workshops_v']) &&  sizeof($eventos['workshops_v']) > 0 ):?>
            <p class="eventos-registro__fecha">Viernes 2 de Febreo</p>
            <div class="eventos-registro__grid eventos--workshops">
                <?php 
                    foreach ($eventos['workshops_v'] as $evento): 
                        include __DIR__ . '/evento.php'; 
                    endforeach;
                    ?>
            </div>
        <?php endif; ?>

        <?php if(isset($eventos['workshops_s']) &&  sizeof($eventos['workshops_s']) > 0 ):?>
            <p class="eventos-registro__fecha">Sábado 3 de Febreo</p>
            <div class="eventos-registro__grid eventos--workshops">
                <?php 
                    foreach ($eventos['workshops_s'] as $evento): 
                        include __DIR__ . '/evento.php'; 
                    endforeach;
                ?>
            </div>
        <?php endif; ?>

        <?php if(isset($eventos['workshops_d']) &&  sizeof($eventos['workshops_d']) > 0 ):?>
            <p class="eventos-registro__fecha">Domingo 4 de Febreo</p>
            <div class="eventos-registro__grid eventos--workshops">
                <?php 
                    foreach ($eventos['workshops_d'] as $evento): 
                        include __DIR__ . '/evento.php'; 
                    endforeach;
                ?>
            </div>
        <?php endif; ?>

    </main>

    <aside class="registro">
        <h2 class="registro__heading">Tu registro</h2>

        <div id="registro-resumen" class="registro__resumen">
            <!-- Aqui se agregan los eventos que selecciona el user con JS -->
        </div>

        <div class="registro__regalo">
            <label for="regalo" class="registro__label">Selecciona un regalo</label>
            <select name="" id="regalo" class="registro__select">
                <option value="">-- Selecciona tu regalo --</option>

                <?php foreach($regalos as $regalo): ?>
                    <option value="<?php echo $regalo->id; ?>"><?php echo $regalo->nombre; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

       <form action="" id="registro" class="formulario">
        <div class="formulario__campo">
            <input type="submit" class="formulario__submit formulario__submit--full" value="Registrarme">
        </div>
       </form> 
    </aside>
</div>