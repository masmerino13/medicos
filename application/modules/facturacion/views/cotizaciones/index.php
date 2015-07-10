<div class="row-fluid">

    <div class="span12">
        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Cotizaciones</span>
                </h4>
            </div>
            <div class="content noPad clearfix">
                <table id="lista" cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th>Correlativo</th>
                        <th>Fecha cotizacion</th>
                        <th>Cliente</th>
                        <th>Sucursal</th>
                        <th>Monto</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($cotizaciones))
                    {
                        foreach($cotizaciones as $row)
                        {
                            ?>
                            <tr>
                                <td><a href="<?= site_url('facturacion/cotizaciones/detalle_cotizacion/'.$row->ect_id)?>"><?=  $row->ect_correlativo?></a></td>
                                <td><?= $row->ect_fecha_documento ?></td>
                                <td><?= $row->cli_nombre_razon_social ?></td>
                                <td><?= $row->src_descripcion?></td>
                                <td><?= setMoneyFormat($row->ect_total)?></td>
                                <td><?= setEstadoCotizacion($row->ect_estado) ?></td>
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