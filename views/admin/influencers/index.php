<h2 class="influencers__heading"><?php echo $titulo;?></h2>

<?php if($error): ?>
    <p class="influencers__description">Eres administrador, pero no un administrador con esos permisos.</p>
<?php endif; ?>

<div class="dashboard__contenedor-boton">
    <a href="/admin/influencers/crear" class="dashboard__boton">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Influencer
    </a>
</div>

<div class="dashboard__contenedor">
    <?php if(!empty($influencers)) { ?>

        <table class="table">
            <thead class="table__head">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Ubicación</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($influencers as $influencer): ?>

                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $influencer->firstName . " " . $influencer->lastName; ?>
                        </td>

                        <td class="table__td">
                            <?php echo $influencer->city . " " . $influencer->country; ?>
                        </td>

                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/influencers/editar?id=<?php echo $influencer->id; ?>">
                                <i class="fa-solid fa-user-pen"></i> Editar
                            </a>

                            <form action="/admin/influencers/eliminar" method="POST" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $influencer->id; ?>">
                                <!-- No es un input submit porque en value no podemos agregar lo de font awesome -->
                                <button type="submit" class="table__accion table__accion--eliminar">
                                    <i class="fa-solid fa-circle-xmark"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>

    <?php } else {?>

        <p class="text-center">Aún no hay influencers.</p>

    <?php } ?>
</div>

<?php 
    echo $paginacion;
?>