<div class="row-fluid">
    <div class="span12">

        <div class="box ">
            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Registrar nuevo cliente</span>
                </h4>
            </div>
            <?php echo validation_errors(); ?>
            <div class="content">
                <?php
                $attributes = array('id' => 'adminForm');
                echo form_open('facturacion/clientes/nuevo',$attributes)
                ?>

                <div class="span6">
                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="cli_id_src">Sucursal</label>
                            <div class="span7" style="margin: 0">
                                <select class="span3 left" id="cli_id_src" name="cli_id_src">
                                    <?php
                                    foreach($sucursales as $row)
                                    {
                                        echo '<option value="'.$row->src_id.'">'.$row->src_descripcion.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="cli_codigo">Codigo</label>
                            <input class="span7 left validate[required,maxSize[20]]" id="cli_codigo" name="cli_codigo" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="cli_nombre_razon_social">Nombre o Razon social</label>
                            <input class="span7 left validate[required]" id="cli_nombre_razon_social" name="cli_nombre_razon_social" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="rol">Tipo cliente</label>
                            <label class="form-label span3"><?= form_radio('cli_tipo_cliente', '1', TRUE);?> Persona natural </label>
                            <label class="form-label span3"><?= form_radio('cli_tipo_cliente', '2', false);?> Persona juridica</label>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="rol">Localización</label>
                            <label class="form-label span3"><?= form_radio('cli_tipo_localizacion', '1', TRUE);?> Nacional </label>
                            <label class="form-label span3"><?= form_radio('cli_tipo_localizacion', '2', false);?> Extranjero</label>
                        </div>
                    </div>

                    <div class="clear"></div>

                    <div class="pDiv">
                        <p>
                            <?= form_button(array('content'=>'<span class="icon16 icomoon-icon-checkmark white"></span>'.SIIE_BTN_SAVE,'class'=>'btn btn-success','type'=>'submit'))?>
                            <?= back() ?>
                        </p>

                    </div>

                </div>

                <?php
                echo form_close();
                ?>

            </div>
            <!-- End .box -->

        </div>
    </div>
</div>