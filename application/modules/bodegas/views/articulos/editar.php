<div class="row-fluid">
    <div class="span12">

        <div class="box ">
            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Edición de articulo</span>
                </h4>
            </div>
            <?php echo validation_errors(); ?>
            <div class="content">
                <?php
                $attributes = array('id' => 'adminForm');
                echo form_open('bodegas/articulos/nuevo',$attributes)
                ?>

                <div class="span6">
                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="art_descripcion">Descripcion:</label>
                            <input class="span7 left validate[required]" id="art_descripcion" name="art_descripcion" type="text" value="<?= @$articulo[0]->art_descripcion?>"  />
                        </div>
                    </div>
                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="art_codigo_inventario">Codigo inventario:</label>
                            <input class="span3 left validate[required]" id="art_codigo_inventario" name="art_codigo_inventario" type="text" value="<?= @$articulo[0]->art_codigo_inventario?>" />
                        </div>
                    </div>
                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="art_iva_incluido">IVA Incluido:</label>
                            <div>
                                <div class="left marginR10">
                                    <?php
                                    /*$params = array(
                                        'name'        => 'art_iva_incluido',
                                        'id'          => 'art_iva_incluido',
                                        'checked'     => @$articulo[0]->art_iva_incluido,
                                        'class'       => 'ibutton nostyle',
                                    );
                                    echo form_checkbox($params);*/
                                    ?>
                                    <input type="checkbox" id="art_iva_incluido" name="art_iva_incluido" <?php if(@$articulo[0]->art_iva_incluido > 0)echo 'checked="checked"' ?> class="ibutton nostyle" />
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="art_iva_incluido">Activo:</label>
                            <div>
                                <div class="left marginR10">
                                    <input type="checkbox" id="art_estado" name="art_estado" <?php if(@$articulo[0]->art_estado > 0)echo 'checked="checked"' ?> class="ibutton nostyle" />
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="art_precio_venta">Precio:</label>
                            <input class="span3 left validate[required, custom[moneyValidate]]" name="art_precio_venta" type="text" value="<?= setMoneyFormat($articulo[0]->art_precio_venta) ?>" />
                        </div>
                    </div>
                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="art_precio_iva">Precio venta:</label>
                            <input class="span3 left validate[required]" readonly id="art_precio_iva" type="text" value="<?= setMoneyFormat($articulo[0]->art_precio_iva)?>" />
                        </div>
                    </div>
                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="art_codigo_inventario">Precio promedio:</label>
                            <input class="span3 left validate[required]" readonly type="text" value="<?= setMoneyFormat(@$articulo[0]->art_precio_promedio)?>" />
                        </div>
                    </div>
                </div>
                <div class="span6">

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="cuenta_compra">Cuenta compra:</label>
                            <input class="span7 left validate[required]" id="cuenta_compra" name="cuenta_compra" type="text" value="<?= @$articulo[0]->cuenta_compra?>" />
                            <a class="btn btn-primary marginR10 marginB10" id="openDialogCompra" ><i class="icomoon-icon-search-3 white" ></i></a>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="cuenta_venta">Cuenta venta:</label>
                            <input class="span7 left validate[required]" id="cuenta_venta" name="cuenta_venta" type="text" value="<?= @$articulo[0]->cuenta_venta?>" />
                            <a class="btn btn-primary marginR10 marginB10" id="openDialogCuentaVenta" ><i class="icomoon-icon-search-3 white" ></i></a>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="cuenta_traslado">Cuenta traslado:</label>
                            <input class="span7 left validate[required]" id="cuenta_traslado" name="cuenta_traslado" type="text" value="<?= @$articulo[0]->cuenta_traslado?>" />
                            <a class="btn btn-primary marginR10 marginB10" id="openDialogCuentaTraslado" ><i class="icomoon-icon-search-3 white" ></i></a>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="art_descripcion">Grupo:</label>
                            <div class="span7 controls sel">
                                <select class="nostyle required span11" id="grp_parent" name="grp_parent">
                                    <option value="0">Seleccionar grupo</option>
                                    <?php
                                    if(!empty($grupos)){
                                        foreach($grupos as $row)
                                        {
                                            if($row->grp_id == $articulo[0]->art_id_grupo)
                                                echo '<option selected value="'.$row->grp_id.'">'.$row->grp_descripcion.'</option>';
                                            else
                                                echo '<option value="'.$row->grp_id.'">'.$row->grp_descripcion.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="art_descripcion">Sub grupo:</label>
                            <div class="span7 controls sel" id="subgrupos_area">
                                <select class="nostyle required span11" id="combobox" name="grp_sub_grupo">
                                    <option value="0">Seleccionar sub grupo</option>
                                    <?php
                                    foreach($subgrupos as $row)
                                    {
                                        if($row->grp_id == $articulo[0]->art_id_sub_grupo)
                                        echo '<option selected value="'.$row->grp_id.'">'.$row->grp_descripcion.'</option>';
                                        else
                                        echo '<option value="'.$row->grp_id.'">'.$row->grp_descripcion.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="clear"></div>

                <div class="pDiv">
                    <p>
                        <?= form_button(array('content'=>'<span class="icon16 icomoon-icon-checkmark white"></span>'.SIIE_BTN_SAVE,'class'=>'btn btn-success','type'=>'submit'))?>
                    </p>

                </div>

                <input type="hidden" id="base_url" value="<?= site_url()?>">
                <input type="hidden" id="tipo" value="0">
                <input type="hidden" id="art_cuenta_compra" name="art_cuenta_compra" value="<?= @$articulo[0]->art_cuenta_compra?>">
                <input type="hidden" id="art_cuenta_venta" name="art_cuenta_venta" value="<?= @$articulo[0]->art_cuenta_venta?>">
                <input type="hidden" id="art_cuenta_traslado" name="art_cuenta_traslado" value="<?= @$articulo[0]->art_cuenta_traslado?>">
                <?php
                echo form_hidden('emp_id',$emp_id);
                echo form_hidden('art_id',@$articulo[0]->art_id);
                echo form_close();
                ?>

            </div>
            <!-- End .box -->

        </div>

</div>
</div>

<div id="cuentasModal">
<?= $this->load->view('contabilidad/cuentas/cuentasModal');?>
</div>