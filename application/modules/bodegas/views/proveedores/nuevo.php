<div class="row-fluid">
    <div class="span12">

        <div class="box ">
            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Registrar nuevo proveedor</span>
                </h4>
            </div>
            <?php echo validation_errors(); ?>
            <div class="content">
                <?php
                $attributes = array('id' => 'adminForm');
                echo form_open('compras/proveedores/nuevo',$attributes)
                ?>

                <div class="span6">
                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="art_descripcion">Codigo:</label>
                            <input class="span7 left validate[required]" id="art_descripcion" name="art_descripcion" type="text" />
                        </div>
                    </div>
                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="art_codigo_inventario">Razón social:</label>
                            <input class="span7 left validate[required]" id="art_codigo_inventario" name="art_codigo_inventario" type="text" />
                        </div>
                    </div>
                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="art_precio_venta">NIT:</label>
                            <input class="span5 left validate[required, custom[integer]]" id="art_precio_venta" name="art_precio_venta" type="text" />
                        </div>
                    </div>
                </div>
                <div class="span6">

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="cuenta_compra">Dirección:</label>
                            <input class="span7 left validate[required]" id="cuenta_compra" name="cuenta_compra" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="cuenta_venta">Contacto:</label>
                            <input class="span7 left validate[required]" id="cuenta_venta" name="cuenta_venta" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="cuenta_traslado">Descripción:</label>
                            <input class="span7 left" id="cuenta_traslado" name="cuenta_traslado" type="text" />
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
                <?php
                echo form_close();
                ?>

            </div>
            <!-- End .box -->

        </div>
    </div>
</div>