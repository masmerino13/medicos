<div class="row-fluid">
    <div class="span12">

        <div class="box ">
            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Registrar nuevo usuario</span>
                </h4>
            </div>
            <?php echo validation_errors(); ?>
            <div class="content">
                <?php
                $attributes = array('id' => 'adminForm');
                echo form_open('usuarios/nuevo',$attributes)
                ?>

                <div class="span6">
                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="usr_persona">Persona</label>
                            <input class="span7 left validate[required]]" id="usr_persona" readonly name="usr_persona" type="text" />
                            <!-- <a class="btn left openModalDialog" id="openModalDialog" data-modal="#modal">...</a> -->
                            <a href="#" class="btn marginR10 marginB10" id="openModalDialog">...</a>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="rol">Rol</label>
                            <input class="span7 left validate[required]]" id="rol" readonly name="rxu_id_rol" type="text" />
                            <a class="btn marginR10 marginB10" id="openDialogRol">...</a>
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="usr_login">Usuario</label>
                            <input class="span8 validate[required]]" name="usr_login" id="usr_login" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box even">
                        <div class="row-fluid">
                            <label class="form-label span3" for="usr_contra">Contraseña</label>
                            <input class="span8 password validate[required]]" id="usr_contra" name="usr_contra" type="password" />
                        </div>
                    </div>

                    <div class="form-field-box even">
                        <div class="row-fluid">
                            <label class="form-label span3" for="usr_contra2">Validar contraseña</label>
                            <input class="span8 validate[required,equals[usr_contra]]" id="usr_contra2" name="usr_contra2" type="password" />
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="per_estado">Estado</label>
                            <?= form_checkbox('usr_estado',1)?>
                        </div>
                    </div>


                </div>

                <div class="clear"></div>

                <div class="pDiv">
                    <p>
                        <?= form_button(array('content'=>'<span class="icon16 icomoon-icon-checkmark white"></span>'.SIIE_BTN_SAVE,'class'=>'btn btn-success','type'=>'submit'))?>
                        <?= back() ?>
                    </p>

                </div>

                <input type="hidden" name="per_id" id="per_id">
                <input type="hidden" name="rol_id" id="rol_id">

                <?php
                echo form_close();
                ?>

                <div id="modal" title="Persona o encargado" class="dialog">
                    <?= $this->load->view('personas/personas_busqueda')?>
                </div>

                <div id="rolModal" title="Rol de usuario" class="dialog">
                    <?php echo $this->load->view('roles/roles_busqueda')?>
                </div>

            </div>
            <!-- End .box -->

        </div>
    </div>
</div>