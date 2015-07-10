<div class="span12">

    <div class="box closed">

        <div class="title">
            <h4>
                <span class="icon16 icomoon-icon-equalizer-2"></span>
                <span>Agregar elemento al formulario</span>
            </h4>
            <a href="#" class="minimize">Minimize</a>
        </div>
        <div class="content">
            <?php
            $attributes = array('id' => 'form-validate');
            echo form_open('medicos/forms/elementos/'.$form_id,$attributes)
            ?>

            <div class="form-row row-fluid">
                <div class="span12">
                    <div class="row-fluid">
                        <label class="form-label span3" for="exf_label">Titulo</label>
                        <div class="span4">
                            <input class="validate[required]" id="exf_label" name="exf_label" type="text" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row row-fluid">
                <div class="span12">
                    <div class="row-fluid">
                        <label class="form-label span3" for="exf_tipo">Tipo elemento</label>
                        <div class="span4">
                            <select class="validate[required]" id="exf_tipo" name="exf_tipo">
                                <option value="0">Seleccionar tipo de elemento</option>
                                <?php
                                if(!empty($tipos))
                                {
                                    foreach($tipos as $tipo)
                                    {
                                        echo '<option value="'.$tipo->tef_id.'">'.$tipo->tef_label.'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row row-fluid">
                <div class="span12">
                    <div class="row-fluid">
                        <label class="form-label span3" for="exf_grupo">Grupo</label>
                        <div class="span4">
                            <select class="validate[required]" id="exf_grupo" name="exf_grupo">
                                <option value="0">Seleccionar grupo elemento</option>
                                <?php
                                if(!empty($grupos))
                                {
                                    foreach($grupos as $grupo)
                                    {
                                        echo '<option value="'.$grupo->exf_id.'">'.$grupo->exf_label.'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row row-fluid">
                <div class="span12">
                    <div class="row-fluid">
                        <label class="form-label span3" for="exf_socio">Asociar con</label>
                        <div class="span4">
                            <select class="" id="exf_socio" name="exf_socio">
                                <option value="0">Seleccionar grupo elemento</option>
                                <?php
                                if(!empty($socios))
                                {
                                    foreach($socios as $socio)
                                    {
                                        echo '<option value="'.$socio->exf_id.'">'.$socio->exf_label.'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row row-fluid">
                <div class="span12">
                    <div class="row-fluid">
                        <div class="form-actions">
                            <div class="span3"></div>
                            <div class="span9 controls">
                                <?= form_button(array('content'=>'<span class="icon16 icomoon-icon-checkmark white"></span>'.SIIE_BTN_SAVE,'class'=>'btn btn-success','type'=>'submit'))?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            echo form_close();
            ?>

        </div>

    </div><!-- End .box -->

</div><!-- End .span12 -->

<div class="span12">

    <div class="box">

        <div class="title">
            <h4>
                <span class="icon16 icomoon-icon-equalizer-2"></span>
                <span>Vista previa del formulario</span>
            </h4>
        </div>
        <div class="content noPad">
            <?php
            $this->load->view('elementos_preview');
            ?>
        </div>
    </div>
</div>