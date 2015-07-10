<div class="row-fluid">

    <div class="span12">

        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Clientes empresa</span>
                </h4>
            </div>
            <div class="content noPad clearfix">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" id="listaArticulos" width="100%">
                    <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Descripción</th>
                        <th>U/Medida</th>
                        <th>Precio prom.</th>
                        <th>Cuenta compra</th>
                        <th>Cuenta venta</th>
                        <th>Cuenta traslado</th>
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
                                <td><?= $row->art_codigo_inventario?></td>
                                <td><?=  $row->art_descripcion?></td>
                                <td>0</td>
                                <td><?=  $row->art_precio_promedio?></td>
                                <td><?=  $row->art_cuenta_compra?></td>
                                <td><?=  $row->art_cuenta_venta?></td>
                                <td><?=  $row->art_cuenta_traslado?></td>
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