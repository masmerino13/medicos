<div class="row-fluid">

    <div class="span12">
        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Creditos fiscales</span>
                </h4>
            </div>
            <div class="content noPad clearfix">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th class="span2">Correlativo</th>
                        <th class="span2">Fecha</th>
                        <th class="span4">Cliente</th>
                        <th class="span4">Sucursal</th>
                        <th class="span2">IVA</th>
                        <th class="span2">Total</th>
                        <th class="span2">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($creditos_fiscales))
                    {
                        foreach($creditos_fiscales as $row)
                        {
                            ?>
                            <tr>
                                <td><a href="<?= site_url('facturacion/facturar/detalle_credito_fiscal/'.setEncode($row->ecf_id))?>"><?=  $row->ecf_correlativo?></a></td>
                                <td><?= $row->ecf_fecha_documento ?></td>
                                <td><?= $row->cli_nombre_razon_social ?></td>
                                <td><?= $row->src_descripcion?></td>
                                <td><?= $row->ecf_iva?></td>
                                <td><?= $row->ecf_total?></td>
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