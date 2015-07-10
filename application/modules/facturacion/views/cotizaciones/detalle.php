<div class="row-fluid">
    <div class="span12">

        <div class="box">
            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Detalle cotización</span>
                </h4>
            </div>
            <div class="content">
                <div class="row-fluid">

                <div class="span6">

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="sucursal">N° Cotización:</label>
                            <?= $cotizacion[0]->ect_correlativo?>
                        </div>
                    </div>

                    <div class="form-field-box even">
                        <div class="row-fluid">
                            <label class="form-label span3" for="cliente">Cliente:</label>
                            <?= $cotizacion[0]->cli_nombre_razon_social?>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3">Vendedor:</label>
                            <?= $cotizacion[0]->vendedor?>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3">Fecha documento:</label>
                            <?= $cotizacion[0]->ect_fecha_documento?>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3">Fecha registro:</label>
                            <?= $cotizacion[0]->ect_fecha?>
                        </div>
                    </div>

                </div>

                <div class="span6">

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="src_descripcion">Sucursal:</label>
                            <?= getSucursalDescripcion() ?>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="pve_descripcion">Punto de venta:</label>
                            <?= getPuntoVentaDescripcion() ?>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="pve_descripcion">Creado por:</label>
                            <?= $cotizacion[0]->creado_por ?>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="pve_descripcion">Estado:</label>
                            <?= setEstadoCotizacion($cotizacion[0]->ect_estado) ?>
                        </div>
                    </div>

                </div>

                <div class="span12" style="margin: 0">
                    <table cellpadding="0" cellspacing="0" border="0" class="responsive display table table-bordered sinformato " id="listaArticulosFacturaSelected">
                        <thead>
                        <tr>
                            <th class="span3">Bodega</th>
                            <th class="span3">Codigo inventario</th>
                            <th>Descripción</th>
                            <th class="span3">U/Medida</th>
                            <th class="span1">Cantidad</th>
                            <th class="span3">Precio Unitario</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!empty($articulos))
                        {
                            foreach($articulos as $row)
                            {
                                $html = '<tr>
                                    <td class="span3">'.$row->bod_descripcion.'</td>
                                    <td class="span3">'.$row->art_codigo_inventario.'</td>
                                    <td>'.$row->art_descripcion.'</td>
                                    <td class="span3"></td>
                                    <td class="span1">'.$row->dct_cantidad.'</td>
                                    <td class="span3">$'.setMoneyFormat($row->dct_precio).'</td>
                                    <td>$'.setMoneyFormat($row->dct_monto).'</td>
                                </tr>';
                                echo $html;
                            }
                        }else{
                            echo '<tr id="0" class="even artAdded"><td colspan="6">Sin articulos agregados</td></tr>';
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
                <div class="span12" style="margin: 0">
                    <div class="span3 right" style="float: right !important;">
                        <label class="span4 left strong alignR">Sumas $:</label><input type="text" class="right span8" id="sumas" name="sumas" readonly value="<?= setMoneyFormat($cotizacion[0]->ect_sumas) ?>" style="float: right">
                    </div>
                </div>
                <div class="span12" style="margin: 0">
                    <div class="span3 right" style="float: right !important;">
                        <label class="span4 left strong alignR">Iva $:</label><input type="text" class="right span8" id="ecf_iva" name="ecf_iva" readonly value="<?= setMoneyFormat($cotizacion[0]->ect_iva)?>" style="float: right">
                    </div>
                </div>
                <div class="span12" style="margin: 0">
                    <div class="span3 right" style="float: right !important;">
                        <label class="span4 left strong alignR">Total $:</label><input type="text" class="right span8" id="efa_total" name="efa_total" readonly value="<?= setMoneyFormat($cotizacion[0]->ect_total) ?>" style="float: right">
                    </div>
                </div>
            <!-- End .box -->

        </div>
    </div>
</div>