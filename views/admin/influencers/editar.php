<h2 class="influencers__heading"><?php echo $titulo;?></h2>

<div class="dashboard__contenedor-boton">
    <a href="/admin/influencers" class="dashboard__boton">
        <i class="fa-solid fa-circle-arrow-left"></i>
        volver
    </a>
</div>

<div class="dashboard__formulario">

    <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

    <form action="" enctype="multipart/form-data" method="POST"  class="formulario">

        <?php include_once __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Actualizar Registro" class="formulario__submit formulario__submit--registrar">
    </form>
</div>