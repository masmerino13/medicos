<div class="row-fluid">
    <div class="span11">

        <div class="box">

            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Personal empresa</span>
                </h4>
            </div>
            <div class="content noPad">
                <table class="responsive table table-bordered" id="listaPersonal">
                    <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Dui</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(count($personal) > 0){
                        foreach($personal as $row)
                        {
                            ?>
                            <tr label="<?= $row->per_primer_nombre.' '.$row->per_segundo_nombre.' '.$row->per_primer_apellido.' '.$row->per_segundo_apellido?>" value="<?= $row->per_id?>">
                                <td><?= $row->per_primer_nombre.' '.$row->per_segundo_nombre?></td>
                                <td><?= $row->per_primer_apellido.' '.$row->per_segundo_apellido?></td>
                                <td><?= $row->per_dui?></td>
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
    </div>
</div>
