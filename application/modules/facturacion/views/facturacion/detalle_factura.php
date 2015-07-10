<div class="row-fluid">
        <div class="box">
            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Detalle factura</span>
                </h4>
            </div>

            <div class="content">
                <div class="row-fluid">

                <div class="span6">
                    <div class="form-field-box even">
                        <div class="row-fluid">
                            <label class="form-label span3" for="cliente">Cliente:</label>
                            <?= $factura[0]->cli_nombre_razon_social?>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="periodo">Periodo fiscal:</label>
                            <?= $factura[0]->periodo?>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="vxe_desc">Vendedor:</label>
                            <?= $factura[0]->vendedor?>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <label class="form-label span3" for="periodo">Fecha factura:</label>
                        <?= $factura[0]->efa_fecha_factura?>
                    </div>

                </div>

                <div class="span6">

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="sucursal">Correlativo:</label>
                            <?= $factura[0]->efa_codigo_factura?>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="src_descripcion">Sucursal:</label>
                            <?= $factura[0]->src_descripcion?>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="pve_descripcion">Punto de venta:</label>
                            <?= $factura[0]->pve_descripcion?>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="bodega">Fecha emisión:</label>
                            <?= $factura[0]->efa_fecha?>
                        </div>
                    </div>

                </div>

                <div class="span12" style="margin: 0">
                    <table cellpadding="0" cellspacing="0" border="0" class="responsive display table table-bordered sinformato " id="listaArticulosFacturaSelected">
                        <thead>
                        <tr>
                            <th class="span3">Codigo inventario</th>
                            <th>Descripción</th>
                            <th class="span1">Cantidad</th>
                            <th class="span3">U/Medida</th>
                            <th class="span3">Precio Unitario</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($items_factura as $row)
                        {
                            $html = '<tr>
                            <td class="span3">'.$row->art_codigo_inventario.'</td>
                            <td>'.$row->art_descripcion.'</td>
                            <td class="span1">'.$row->dfa_cantidad.'</td>
                            <td class="span3"></td>
                            <td class="span3">'.$row->dfa_precio.'</td>
                            <td>'.$row->dfa_monto.'</td>
                        </tr>';
                            echo $html;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="span12" style="margin: 0">
                    <div class="span3 right" style="float: right !important;">
                        <label class="span4 left strong alignR">SubTotal $:</label><input type="text" class="right span8" id="efa_subtotal" name="efa_subtotal" readonly value="0" style="float: right">
                    </div>
                </div>
<div class="span12" style="margin: 0">
                    <div class="span3 right" style="float: right !important;">
                        <label class="span4 left strong alignR">Iva $:</label><input type="text" class="right span8" id="efa_total_iva" name="efa_total_iva" readonly value="0" style="float: right">
                    </div>
                </div>
<div class="span12" style="margin: 0">
                    <div class="span3 right" style="float: right !important;">
                        <label class="span4 left strong alignR">Total $:</label><input type="text" class="right span8" id="efa_total" name="efa_total" readonly value="<?= $factura[0]->efa_monto?>" style="float: right">
                    </div>
                </div>
                </div>
            </div>
            <!-- End .box -->

        </div>
</div>