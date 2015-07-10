<div class="row-fluid">
    <div class="span12">

        <div class="box">
            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Nuevo formulario</span>
                </h4>
            </div>

                <?php
                $attributes = array('id' => 'adminForm');
                echo form_open('medicos/forms/nuevo',$attributes)
                ?>
            <div class="content">
                <div class="row-fluid">
                <div class="span6">

                    <div class="form-field-box even">
                        <div class="row-fluid">
                            <label class="form-label span3" for="fxc_titulo">Titulo</label>
                            <input class="span7 left validate[required]" id="fxc_titulo" name="fxc_titulo" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box even">
                        <div class="row-fluid">
                            <label class="form-label span3" for="fxc_descripcion">Descripción corta</label>
                            <textarea class="span7 left" id="fxc_descripcion" name="fxc_descripcion" rows="5"></textarea>
                        </div>
                    </div>

                    </div>

            </div>
                <div class="clear"></div>
                <div class="pDiv marginT10">
                    <p>
                        <?= form_button(array('content'=>'<span class="icon16 icomoon-icon-checkmark white"></span>'.SIIE_BTN_SAVE,'class'=>'btn btn-success','type'=>'submit'))?>
                    </p>

                </div>
            </div>


                <?= form_close(); ?>

        </div>
    </div>
</div>