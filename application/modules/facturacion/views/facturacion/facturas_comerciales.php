<div class="row-fluid">

    <div class="span12">
        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Facturas</span>
                </h4>
            </div>
            <div class="content noPad clearfix">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th class="span2">Correlativo</th>
                        <th class="span2">Fecha factura</th>
                        <th>Cliente</th>
                        <th>Sucursal</th>
                        <th>Punto de venta</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($facturas))
                    {
                        foreach($facturas as $row)
                        {
                            ?>
                            <tr>
                                <td><a href="<?= site_url('facturacion/facturar/detalle_factura/'.setEncode($row->efa_id))?>"><?=  $row->efa_codigo_factura?></a></td>
                                <td><?= $row->efa_fecha_factura ?></td>
                                <td><?= $row->cli_nombre_razon_social ?></td>
                                <td><?= $row->src_descripcion?></td>
                                <td><?= $row->pve_descripcion?></td>
                                <td>...</td>
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