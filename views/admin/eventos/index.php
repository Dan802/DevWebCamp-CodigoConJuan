<h2 class="eventos__heading"><?php echo $titulo;?></h2>

<?php if($error): ?>
    <p class="influencers__description">Eres administrador, pero no un administrador con esos permisos.</p>
<?php endif; ?>

<div class="dashboard__contenedor">
    <?php if(!empty($eventos)) { ?>

        <table class="table">
            <thead class="table__head">
                <tr>
                    <th scope="col" class="table__th">Evento</th>
                    <th scope="col" class="table__th">Categoría</th>
                    <th scope="col" class="table__th">Día y Hora</th>
                    <th scope="col" class="table__th">Influencer</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($eventos as $evento): ?>

                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $evento->nombre; ?>
                        </td>

                        <td class="table__td">
                            <?php echo $evento->categoria->nombre; ?>
                        </td>

                        <td class="table__td">
                            <?php echo $evento->dia->nombre . ", " . $evento->hora->hora; ?>
                        </td>

                        <td class="table__td">
                            <?php echo $evento->influencer->firstName . $evento->influencer->lastName; ?>
                        </td>

                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/eventos/editar?id=<?php echo $evento->id; ?>">
                                <i class="fa-solid fa-pencil"></i> Editar
                            </a>

                            <form action="/admin/eventos/eliminar" method="POST" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $evento->id; ?>">
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

        <p class="text-center">Aún no hay eventos.</p>

    <?php } ?>
</div>

<?php 
    echo $paginacion;
?>


<div class="dashboard__contenedor-boton">
    <a href="/admin/eventos/crear" class="dashboard__boton">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Evento
    </a>
</div>