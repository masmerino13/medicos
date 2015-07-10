<div class="row-fluid">

    <div class="span12">

        <form class="form-horizontal seperator">
            <fieldset>
                <legend><?= $paciente[0]->nombre_completo ?></legend>

                <div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <img src="<?= base_url()?>assets/images/medicos/default_user.png" alt="" class="image marginR10" width="100"/>
                        </div>
                    </div>
                </div>

                <div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <label class="form-label span3" for="name">Codigo paciente:</label>
                            <?= $paciente[0]->pac_codigo_paciente?>
                        </div>
                    </div>
                </div>

                <div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <label class="form-label span3" for="name">Fecha nacimiento:</label>
                            <?= $paciente[0]->pac_fecha_nacimiento?>
                        </div>
                    </div>
                </div>

                <div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <label class="form-label span3" for="email">Diagnostico:</label>
                            <?= $paciente[0]->pac_observacion?>
                        </div>
                    </div>
                </div>

                <div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <label class="form-label span3" for="email">Dirección:</label>
                            <?= $paciente[0]->pac_direccion?>
                        </div>
                    </div>
                </div>

                <div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <label class="form-label span3" for="email">Telefono(s):</label>
                            <div class="span4">
                                <?= setSeparadosByComa($paciente[0]->pac_telefonos)?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <label class="form-label span3" for="email">Correo(s):</label>
                            <div class="span4">
                                <?= setSeparadosByComa($paciente[0]->pac_correos)?>
                            </div>
                        </div>
                    </div>
                </div>

            </fieldset>

        </form>

    </div><!-- End .span12 -->
</div>