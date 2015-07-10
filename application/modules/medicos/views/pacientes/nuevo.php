<div class="row-fluid">
    <div class="span12">

        <div class="box">
            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Nuevo paciente</span>
                </h4>
            </div>

                <?php
                $attributes = array('id' => 'adminForm');
                echo form_open('medicos/pacientes/nuevo',$attributes)
                ?>
            <div class="content">
                <div class="row-fluid">
                <div class="span6">

                    <div class="form-field-box even">
                        <div class="row-fluid">
                            <label class="form-label span3" for="pac_primer_nombre">Primer nombre</label>
                            <input class="span7 left validate[required]" id="pac_primer_nombre" name="pac_primer_nombre" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box even">
                        <div class="row-fluid">
                            <label class="form-label span3" for="pac_segundo_nombre">Segundo nombre</label>
                            <input class="span7 left" id="pac_segundo_nombre" name="pac_segundo_nombre" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box even">
                        <div class="row-fluid">
                            <label class="form-label span3" for="pac_primer_apellido">Primer apellido</label>
                            <input class="span7 left validate[required]" id="pac_primer_apellido" name="pac_primer_apellido" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box even">
                        <div class="row-fluid">
                            <label class="form-label span3" for="pac_segundo_apellido">Segundo apellido</label>
                            <input class="span7 left" id="pac_segundo_apellido" name="pac_segundo_apellido" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box even">
                        <div class="row-fluid">
                            <label class="form-label span3" for="pac_fecha_nacimiento">Fecha nacimiento</label>
                            <input class="span7 left validate[required] campo_fecha" id="pac_fecha_nacimiento" name="pac_fecha_nacimiento" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box even">
                        <div class="row-fluid">
                            <label class="form-label span3" for="pac_direccion">Dirección</label>
                            <input class="span7 left validate[required]" id="pac_direccion" name="pac_direccion" type="text" />
                        </div>
                    </div>

                    </div>

                    <div class="span5">

                            <div class="form-field-box even">
                                <div class="row-fluid">
                                    <label class="form-label span3" for="pac_telefonos">Teléfono(s)</label>
                                    <input class="span7 left" id="pac_telefonos" name="pac_telefonos" type="text" placeholder="Eje: 00000000,22220000,2232-3322" />
                                </div>
                            </div>

                            <div class="form-field-box even">
                                <div class="row-fluid">
                                    <label class="form-label span3" for="pac_correos">Correo(s)</label>
                                    <input class="span7 left" id="pac_correos" name="pac_correos" type="text" placeholder="Eje: mail@mail.com,correo@mail.com" />
                                </div>
                            </div>

                        <div class="form-field-box even">
                            <div class="row-fluid">
                                <label class="form-label span3" for="pac_diagnostico">Diagnostico</label>
                                <textarea class="span7 left validate[required]" id="pac_diagnostico" name="pac_diagnostico" rows="5"></textarea>
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