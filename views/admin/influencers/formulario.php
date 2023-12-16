<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Personal</legend>

    <div class="formulario__campo">
        <label for="firstName" class="formulario__label">Nombre</label>
        <input 
            type="text" 
            name="firstName" 
            id="firstName" 
            class="formulario__input"
            placeholder="First Name" 
            value="<?php echo $influencer->firstName ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label for="lastName" class="formulario__label">Apellido</label>
        <input 
            type="text" 
            name="lastName" 
            id="lastName" 
            class="formulario__input"
            placeholder="Last Name" 
            value="<?php echo $influencer->lastName ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label for="city" class="formulario__label">Ciudad</label>
        <input 
            type="text" 
            name="city" 
            id="city" 
            class="formulario__input"
            placeholder="City" 
            value="<?php echo $influencer->city ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label for="country" class="formulario__label">País</label>
        <input 
            type="text" 
            name="country" 
            id="country" 
            class="formulario__input"
            placeholder="Country" 
            value="<?php echo $influencer->country ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label for="imagen" class="formulario__label">Imágen</label>
        <input 
            type="file" 
            name="image" 
            id="imagen" 
            class="formulario__input formulario__input--file">
    </div>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra</legend>

    <div class="formulario__campo">
        <label for="tags_input" class="formulario__label">Áreas de Experiencia (separadas por coma)</label>
        <input 
            type="text" 
            id="tags_input" 
            class="formulario__input"
            placeholder="Ej. Just chatting, videogames, irl, podcast, only sleeping...">
    </div>

    <div class="formulario__listado" id="tags"></div>
    <input type="hidden" name="tags" value="<?php echo $influencer->tags ?? ''; ?>">

</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Redes Sociales</legend>

    <div class="formulario__campo">
        <div class="formulario__contenedor--icono">

            <div class="formulario__icono">
                <i class="fa-brands fa-twitch"></i>
            </div>
            <input 
                type="text" 
                name="redes[twitch]" 
                class="formulario__input--sociales"
                placeholder="Twitch" 
                value="<?php echo $influencer->twitch ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor--icono">

            <div class="formulario__icono">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input 
                type="text" 
                name="redes[twitter]" 
                class="formulario__input--sociales"
                placeholder="Twitter" 
                value="<?php echo $influencer->twitter ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor--icono">

            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input 
                type="text" 
                name="redes[tiktok]" 
                class="formulario__input--sociales"
                placeholder="Tiktok" 
                value="<?php echo $influencer->tiktok ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor--icono">

            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input 
                type="text" 
                name="redes[youtube]" 
                class="formulario__input--sociales"
                placeholder="Youtube" 
                value="<?php echo $influencer->youtube ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor--icono">

            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input 
                type="text" 
                name="redes[instagram]" 
                class="formulario__input--sociales"
                placeholder="Instagram" 
                value="<?php echo $influencer->instagram ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor--icono">

            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input 
                type="text" 
                name="redes[facebook]" 
                class="formulario__input--sociales"
                placeholder="Facebook" 
                value="<?php echo $influencer->facebook ?? ''; ?>">
        </div>
    </div>
</fieldset>