<div class="row-fluid">

    <div class="span12">

        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Lista articulos:</span>
                </h4>
            </div>
            <div class="content noPad clearfix">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" id="listaBodegas" width="100%">
                    <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Razón social</th>
                        <th>NIT</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($proveedores))
                    {
                        foreach($proveedores as $row)
                        {
                            ?>
                            <tr>
                                <td><a href="<?= site_url('bodegas/articulos/editar/'.$row->prv_id)?>"><?= $row->prv_codigo?></a></td>
                                <td><?= $row->prv_razon_social?></td>
                                <td><?= $row->prv_nit ?></td>
                                <td><?= $row->prv_estado ?></td>
                                <td></td>
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