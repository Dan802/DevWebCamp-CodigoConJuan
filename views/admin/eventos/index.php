<h2 class="eventos__heading"><?php echo $titulo;?></h2>

<?php $i = 1; ?>
<?php foreach ($eventos as $evento):?>

    <p><?php echo $i . '. ' . $evento->nombre;  ?></p>
    <?php $i++; ?>
        
<?php endforeach; ?>    


<div class="dashboard__contenedor-boton">
    <a href="/admin/eventos/crear" class="dashboard__boton">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Evento
    </a>
</div>