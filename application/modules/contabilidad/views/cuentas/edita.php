<div class="row-fluid">
    <div class="span12">

        <div class="box gradient">
            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Editar cuenta contable</span>
                </h4>
            </div>
            <?php echo validation_errors(); ?>
            <div class="content">
                <?php
                $attributes = array('id' => 'adminForm');
                echo form_open(site_url('contabilidad/cuentas'),$attributes)
                ?>
                <div class="span6">
                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="ccc_cuenta">Cuenta:</label>
                            <input class="span5 left validate[required,custom[integer]]" id="ccc_cuenta" name="ccc_cuenta" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="ccc_descripcion">Descripción:</label>
                            <input class="span7 left validate[required]" id="ccc_descripcion" name="ccc_descripcion" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="ccc_detalle">Detalle:</label>
                            <div>
                                <div class="left marginR10">
                                    <input type="checkbox" id="ccc_detalle" name="ccc_detalle" class="ibutton nostyle" />
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="span6">
                <div class="form-field-box odd">
                    <div class="row-fluid">
                        <label class="form-label span3" for="ccc_tipo_cuenta">Tipo cuenta:</label>
                        <div class="span7">
                            <select class="nostyle required span11" id="ccc_tipo_cuenta" name="ccc_tipo_cuenta">
                                <option value="0">Nivel superior</option>
                                <?php
                                if(!empty($tiposCuenta)){
                                    foreach($tiposCuenta as $row)
                                    {
                                        echo '<option value="'.$row['id'].'">'.$row['label'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-field-box odd">
                    <div class="row-fluid">
                        <label class="form-label span3" for="ccc_parent">Depende de:</label>
                        <input class="span5 left validate[required]" id="ccc_parent" name="ccc_parent" type="text" value="0" />
                    </div>
                </div>

                </div>

                <div class="clear"></div>

                <div class="pDiv">
                    <p>
                        <?= form_button(array('content'=>'<span class="icon16 icomoon-icon-checkmark white"></span>'.SIIE_BTN_SAVE,'class'=>'btn btn-success','type'=>'submit'))?>
                    </p>

                </div>

                <input type="hidden" id="ccc_id" name="ccc_id"/>
                <?php
                echo form_close();
                ?>

            </div>
            <!-- End .box -->

        </div>
    </div>
</div>