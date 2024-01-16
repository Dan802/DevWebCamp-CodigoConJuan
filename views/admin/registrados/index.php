<h2 class="registrados__heading"><?php echo $titulo;?></h2>

<div class="dashboard__contenedor">
    <?php if(!empty($registros)) { ?>

        <table class="table">
            <thead class="table__head">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Correo</th>
                    <th scope="col" class="table__th">Plan</th>
                    <th scope="col" class="table__th">Regalo</th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($registros as $registro): ?>

                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $registro->usuario->nombre . " " . $registro->usuario->apellido; ?>
                        </td>

                        <td class="table__td">
                            <?php echo substr($registro->usuario->email, 0, 5) . '...'; ?>
                        </td>

                        <td class="table__td">
                            <?php echo $registro->paquete->nombre; ?>
                        </td>
                        
                        <td class="table__td">
                            <?php echo $registro->regalo->nombre; ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>

    <?php } else {?>

        <p class="text-center">Aún no hay registros.</p>

    <?php } ?>
</div>

<?php 
    echo $paginacion;
?>