<div class="row-fluid">
    <div class="span12">

        <div class="box ">
            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Nuevo periodo fiscal</span>
                </h4>
            </div>
            <div class="content">
                <?php
                $attributes = array('id' => 'adminForm');
                echo form_open('periodo_fiscal/nuevo',$attributes)
                ?>

                <div class="span6">
                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="pef_mes">Mes</label>
                            <div class="span7 left" style="margin-left: 0">
                                <?php
                                $js = 'id="pef_mes" class="validate[required]"  style="margin-left: 0"';
                                echo form_dropdown('pef_mes', $meses, date('n'),$js);
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="pef_anio">Año</label>
                            <input class="span7 left validate[required]" id="pef_anio" readonly value="<?= date('Y')?>" name="pef_anio" type="text" />
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