<fieldset class="formulario_fieldset">
    <legend class="formulario__legend">Información del Evento</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre del Evento</label>
        <input 
            type="text" 
            name="nombre" 
            id="nombre" 
            class="formulario__input"
            placeholder="Nombre del Evento"
            value="<?php echo $evento->nombre; ?>">
    </div>

    <div class="formulario__campo">
        <label for="descripcion" class="formulario__label">Descripción del Evento</label>
        <textarea 
            name="descripcion" 
            id="descripcion" 
            rows="8"
            class="formulario__input"
            placeholder="Descripción del Evento"
        ><?php echo $evento -> descripcion; ?></textarea>
    </div>

    <div class="formulario__campo">
        <label for="categoria" class="formulario__label">Categoría</label>
        <select name="categoria_id" id="categoria" class="formulario__select">
            <option value="">- Seleccionar -</option>
            <?php foreach($categorias as $categoria) { ?>
                <option <?php //echo ($evento->categoria_id === $categoria->id) ? 'selected' : '';  ?> value="<?php echo $categoria->id; ?>">

                    <?php echo $categoria->nombre; ?>

                </option>
            <?php } ?>
        </select>
    </div>

    <div class="formulari__campo">
        <label for="categoria" class="formulario__label">Selecciona el día</label>

        <div class="formulario__radio">
            <?php foreach($dias as $dia) { ?>
                <label for="<?php echo strtolower($dia->nombre); ?>"><?php echo $dia->nombre; ?></label>
                <input type="radio"
                id="<?php echo strtolower($dia->nombre); ?>"
                name="dia"
                value="<?php echo $dia->id; ?>
                <?php //($dia->id === $evento->dia_id) ? 'selected' : ''; ?>">
            <?php } ?>
        </div>

        <input type="hidden" name="dia_id" value=""> 
    </div>


    <!-- <div class="formulario__campo">
        <label for="dia_inicio" class="formulario__label">Día de Inicio</label>

        <input type="date" 
                name="dia_inicio" 
                id="dia_inicio"
                placeholder="YYYY/MM/DD"
                value="<?php //echo $dias->dia_inicio ?? ''; ?>">
                    
    </div> -->

    <!-- <div class="formulario__campo">
        <label for="dia_fin" class="formulario__label">Día Final</label>

        <input type="date" 
                name="dia_fin" 
                id="dia_fin"
                placeholder="YYYY/MM/DD"
                value="<?php //echo $dias->dia_fin ?? ''; ?>">
                    
    </div> -->

    <div class="formulario__campo" id="horas">
        <label for="" class="formulario__label">Seleccionar un Hora</label>

        <ul id="horas" class="horas">
            <?php foreach($horas as $hora): ?>
            
            <li data-horaId="<?php echo $hora->id; ?>" class="horas__hora horas__hora--deshabilitada">
                <?php echo $hora->hora; ?>
            </li>
                
            <?php endforeach; ?>
        </ul>

        <input type="hidden" name="hora_id" value=""> 

    </div>

</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra del Evento</legend>

    <div class="formulario__campo">
        <label for="influencer" class="formulario__label">Influencer</label>
        <input 
            type="text" 
            id="influencers"
            class="formulario__input"
            placeholder="Buscar Influencer"
            value="<?php echo $evento->influencer_id; ?>"
        >
        
        <ul id="listado-influencers" class="listado-influencers"></ul>

        <input type="hidden" name="influencer_id" value="">
    </div>

    <div class="formulario__campo">
        <label for="disponibles" class="formulario__label">Lugares Disponibles</label>
        <input 
            type="number" 
            id="disponibles" 
            name="disponibles"
            min="1" max="1000000"
            class="formulario__input"
            placeholder="Ej. 20"
            value="<?php echo $evento->disponibles; ?>">
            

    </div>
</fieldset>