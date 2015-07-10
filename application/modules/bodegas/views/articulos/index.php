<div class="row-fluid">

    <div class="span12">

        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Listado articulos:</span>
                </h4>
            </div>
            <div class="content noPad clearfix">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" id="listaBodegas" width="100%">
                    <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Codigo inventario</th>
                        <th>Cuenta compra</th>
                        <th>Cuenta venta</th>
                        <th>Cuenta traslado</th>
                        <th>Precio</th>
                        <th>Precio venta</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($articulos))
                    {
                        foreach($articulos as $row)
                        {
                            ?>
                            <tr label="<?= $row->art_descripcion ?>" value="<?= $row->art_id?>">
                                <td><a href="<?= site_url('bodegas/articulos/editar/'.$row->art_id)?>"><?= $row->art_descripcion?></a></td>
                                <td><?= $row->art_codigo_inventario?></td>
                                <td><?= $row->cuenta_compra ?></td>
                                <td><?= $row->cuenta_venta ?></td>
                                <td><?= $row->cuenta_traslado ?></td>
                                <td><?= setMoneyFormat($row->art_precio_venta) ?></td>
                                <td><?= setMoneyFormat($row->art_precio_iva) ?></td>
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