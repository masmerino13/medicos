<div class="row-fluid">
    <div class="span12">

        <div class="box">
            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Nueva devolución</span>
                </h4>
            </div>
            <?php echo validation_errors(); ?>
            <div class="content">
                <?php
                $attributes = array('id' => 'adminForm');
                echo form_open('facturacion/facturar/nueva_devolucion',$attributes)
                ?>

                <div class="span6">
                    <div class="form-field-box even">
                        <div class="row-fluid">
                            <label class="form-label span3" for="cliente">Cliente</label>
                            <input class="span7 left validate[required]" readonly id="cliente" name="cliente" value="<?= @$cotizacion[0]->cli_nombre_razon_social?>" type="text" />
                            <a class="btn btn-primary marginR10 marginB10" id="openDialogClientes" ><i class="icomoon-icon-search-3 white" ></i></a>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="efa_correlativo">Factura</label>
                            <input class="span7 required" readonly id="efa_correlativo" name="efa_correlativo" type="text" />
                            <a class="btn btn-primary marginR10 marginB10" id="openDialogFactura"><i class="icomoon-icon-search-3 white" ></i></a>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="periodo">Periodo fiscal</label>
                            <input class="span7 required" readonly id="periodo" name="periodo" type="text" value="<?= $periodo?>" />
                            <a class="btn btn-primary marginR10 marginB10" id="openDialogPeriodos"><i class="icomoon-icon-search-3 white" ></i></a>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="fad_fecha_documento">Fecha</label>
                            <input class="span4 validate[required, ajax[validaFechaFactura]]" id="fad_fecha_documento" name="fad_fecha_documento" type="text" value="<?= date('Y/m/d')?>" />
                        </div>
                    </div>

                </div>

                <div class="span6">

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="sucursal">N° Referencia</label>
                            <input class="span4 validate[required,ajax[validaCodigoFactura]]" id="correlativo" name="correlativo" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="src_descripcion">Sucursal</label>
                            <input class="span8" readonly id="src_descripcion" name="src_descripcion" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="pve_descripcion">Punto de venta</label>
                            <input class="span8" readonly id="pve_descripcion" name="pve_descripcion" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="fad_descripcion">Descripción</label>
                            <textarea name="fad_descripcion" id="fad_descripcion" class="span8"></textarea>
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
                        if(!empty($articulos_cotizacion))
                        {
                            foreach($articulos_cotizacion as $row):
                                $monto = setMoneyFormat($row->dct_precio * $row->dct_cantidad, 2);

                                $html = '<tr class="artAdded" id="'.$row->art_id.'">';
                                $html .= '<td class="sorting_1">0000001</td>';
                                $html .= '<td>'.$row->art_descripcion.'</td>';
                                $html .= '<td><input type="text" value="'.$row->dct_cantidad.'" name="articulo['.$row->art_id.'][cant]" readonly="" class="readonly span2 number_format"></td>';
                                $html .= '<td>Unidad</td>';
                                $html .= '<td><input type="text" value="'.$row->dct_precio.'" name="articulo['.$row->art_id.'][precio]" readonly="" class="readonly span2"><input type="hidden" name="articulo['.$row->art_id.'][bodega]" value="'.$row->bod_id.'"></td>';
                                $html .= '<td class="number_format">'.$monto.'</td>';
                                $html .= '</tr>';
                                echo $html;
                            endforeach;
                        }else{
                            echo '<tr id="0" class="even artAdded"><td colspan="6">Sin articulos agregados</td></tr>';
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
                <div class="span12" style="margin: 0">
                    <div class="span3 right" style="float: right !important;">
                        <label class="span4 left strong alignR">SubTotal $:</label><input type="text" class="right span8" id="sumas" name="sumas" readonly value="<?= @$cotizacion[0]->ect_total?>" style="float: right">
                    </div>
                </div>
                <div class="span12" style="margin: 0">
                    <div class="span3 right" style="float: right !important;">
                        <label class="span4 left strong alignR">Iva $:</label><input type="text" class="right span8" id="efa_total_iva" name="efa_total_iva" readonly value="0" style="float: right">
                    </div>
                </div>
                <div class="span12" style="margin: 0">
                    <div class="span3 right" style="float: right !important;">
                        <label class="span4 left strong alignR">Total $:</label><input type="text" class="right span8" id="efa_total" name="efa_total" readonly value="<?= @$cotizacion[0]->ect_total?>" style="float: right">
                    </div>
                </div>

                <div class="clear"></div>

                <div class="pDiv marginT10">
                    <p>
                        <?= form_button(array('content'=>'<span class="icon16 icomoon-icon-checkmark white"></span>'.SIIE_BTN_SAVE,'class'=>'btn btn-success','type'=>'submit'))?>
                    </p>

                </div>

                <input type="hidden" name="efa_id_pve" id="efa_id_pve" value="<?= getPuntoVentaId()?>">
                <input type="hidden" name="efa_id_src" id="efa_id_src" value="<?= getSucursalId()?>">
                <input type="hidden" name="efa_id_cli" id="efa_id_cli" value="<?= @$cotizacion[0]->cli_id?>">
                <input type="hidden" name="efa_id_pef" id="efa_id_pef" value="<?= $pef_id?>">
                <input type="hidden" name="efa_id" id="efa_id">
                <input type="hidden" name="bod_id" id="bod_id">
                <input type="hidden" id="base_url" value="<?= site_url()?>">
                <?php
                echo form_close();
                ?>

            </div>
            <!-- End .box -->

        </div>
    </div>
</div>

<div id="clientesModal">
    <?php
    $this->load->view('/clientes/clientes_modal');
    ?>
</div>

<div id="facturasModal">
    <?php
    $this->load->view('/facturacion/facturasModal');
    ?>
</div>