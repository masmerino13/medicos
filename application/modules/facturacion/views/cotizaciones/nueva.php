<div class="row-fluid">
    <div class="span12">

        <div class="box">
            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Nueva cotización</span>
                </h4>
            </div>
            <?php echo validation_errors(); ?>
            <div class="content">
                <?php
                $attributes = array('id' => 'adminForm');
                echo form_open('facturacion/cotizaciones/inserta_cotizacion',$attributes)
                ?>

                <div class="span6">

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="sucursal">N° Cotización</label>
                            <input class="span8 validate[required,ajax[validaCorrelativoCotizacion]]" id="correlativo" name="correlativo" type="text" value="<?= $config['FAC_COT'].$codigo_factura?>" />
                        </div>
                    </div>

                    <div class="form-field-box even">
                        <div class="row-fluid">
                            <label class="form-label span3" for="cliente">Cliente</label>
                            <input class="span7 left validate[required]" readonly id="cliente" name="cliente" type="text" />
                            <a class="btn btn-primary marginR10 marginB10" id="openDialogClientes" ><i class="icomoon-icon-search-3 white" ></i></a>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="vxe_desc">Vendedor</label>
                            <input class="span7 required" readonly id="vxe_desc" name="vxe_desc" type="text" />
                            <a class="btn btn-primary marginR10 marginB10" id="openDialogVendedores"><i class="icomoon-icon-search-3 white" ></i></a>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3">Fecha</label>
                            <input class="span3" id="ect_fecha_documento" name="ect_fecha_documento" type="text" />
                        </div>
                    </div>

                </div>

                <div class="span6">

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="src_descripcion">Sucursal</label>
                            <input class="span8" readonly id="src_descripcion" name="src_descripcion" type="text" value="<?= getSucursalDescripcion() ?>" />
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="pve_descripcion">Punto de venta</label>
                            <input class="span8" readonly id="pve_descripcion" name="pve_descripcion" type="text" value="<?= getPuntoVentaDescripcion() ?>" />
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="bodega">Bodega</label>
                            <input class="span8 validate[required]" readonly id="bodega" name="bodega" type="text" />
                            <a class="btn btn-primary marginR10 marginB10" id="openDialogBodegas"><i class="icomoon-icon-search-3 white" ></i></a>
                        </div>
                    </div>

                </div>

                <div class="span12" style="margin: 0">
                    <a id="getArticulosBodega" class="btn btn-primary btn-mini right marginB5">Buscar Articulos</a>
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
                        <tr id="0" class="even artAdded"><td colspan="6">Sin articulos agregados</td></tr>
                        </tbody>
                    </table>

                </div>
                <div class="span12" style="margin: 0">
                    <div class="span3 right" style="float: right !important;">
                        <label class="span4 left strong alignR">Sumas $:</label><input type="text" class="right span8" id="sumas" name="sumas" readonly value="0" style="float: right">
                    </div>
                </div>
                <div class="span12" style="margin: 0">
                    <div class="span3 right" style="float: right !important;">
                        <label class="span4 left strong alignR">Iva $:</label><input type="text" class="right span8" id="ecf_iva" name="ecf_iva" readonly value="0" style="float: right">
                    </div>
                </div>
                <div class="span12" style="margin: 0">
                    <div class="span3 right" style="float: right !important;">
                        <label class="span4 left strong alignR">Total $:</label><input type="text" class="right span8" id="efa_total" name="efa_total" readonly value="0" style="float: right">
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
                <input type="hidden" name="efa_id_cli" id="efa_id_cli">
                <input type="hidden" name="bod_id" id="bod_id">
                <input type="hidden" name="efa_id_vxe" id="efa_id_vxe">
                <input type="hidden" id="base_url" value="<?= base_url()?>">

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

<div id="vendedoresModal">
    <?php
    $this->load->view('facturacion/vendedores/vendedores_modal');
    ?>
</div>

<div id="periodosModal">
    <?php
    $this->load->view('/periodos/periodos_modal');
    ?>
</div>

<div id="bodegasModal">
    <?php
    $this->load->view('bodegas/bodegas/bodegas_modal');
    ?>
</div>

<div id="articuloModal">
    Descuentos articulo
</div>

<div id="articulosModal">
    <div id="listadoArticulos">

    </div>
    <div id="formularioArticuloAdd">

    </div>
</div>