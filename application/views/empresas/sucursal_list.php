<div class="box">

    <div class="title">
        <h4>
            <span class="icon16 icomoon-icon-equalizer-2"></span>
            <span>Puntos de venta registrados</span>
        </h4>
        <a href="#" class="minimize">Minimize</a>
    </div>
    <div class="content noPad">
        <table class="responsive table table-bordered">
            <thead>
            <tr>
                <th>Descripción</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(!empty($puntos)){
                foreach($puntos as $row)
                {
                    ?>
                    <tr>
                        <td><?= $row->pve_descripcion?></td>
                        <td>
                            <?php echo set_permiso_usuario(); ?>
                        </td>
                    </tr>
                <?php
                }
            }
            ?>

            </tbody>
        </table>
    </div>
</div>