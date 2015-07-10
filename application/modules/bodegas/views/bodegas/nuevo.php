<div class="row-fluid">
    <div class="span12">

        <div class="box ">
            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Registrar nueva Bodega</span>
                </h4>
            </div>
            <?php echo validation_errors(); ?>
            <div class="content">
                <?php
                $attributes = array('id' => 'adminForm');
                echo form_open('bodegas/bodegas/nuevo',$attributes)
                ?>

                <div class="span6">
                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="bod_descripcion">Descripcion:</label>
                            <input class="span7 left" id="bod_descripcion" name="bod_descripcion" type="text" />
                        </div>
                    </div>



                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="rol">Estado:</label>
                            <label class="form-label span3"><?= form_radio('bod_estado', '1', TRUE);?> Activo </label>
                            <label class="form-label span3"><?= form_radio('bod_estado', '2', false);?> Inactivo</label>
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