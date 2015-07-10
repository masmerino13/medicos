<div class="row-fluid">

    <div class="span6">

        <form class="form-horizontal seperator">
            <fieldset>
                <legend><?= $paciente[0]->pac_primer_nombre.' '.$paciente[0]->pac_segundo_nombre.' '.$paciente[0]->pac_primer_apellido.' '.$paciente[0]->pac_segundo_apellido?></legend>

            <div class="form-row row-fluid">
                <div class="span12">
                    <div class="row-fluid">
                        <img src="<?= base_url()?>assets/images/medicos/default_user.png" alt="" class="image marginR10" width="150"/>
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

    <div class="span6">
        <fieldset>
            <legend>Acciones</legend>

            <div class="centerContent">

                <ul class="bigBtnIcon">
                    <li>
                        <a href="<?= site_url('medicos/consultas/seleccion_form/'.$paciente[0]->pac_key)?>" title="Realizar una nueva consulta" class="tipB">
                            <span class="icon wpzoom-medicine"></span>
                            <span class="txt">Nueva consulta</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('medicos/citas/nueva/'.$paciente[0]->pac_key)?>" title="Programar una nueva cita" class="tipB">
                            <span class="icon icomoon-icon-calendar"></span>
                            <span class="txt">Nueva cita</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Realiza una nueva receta" class="tipB">
                            <span class="icon icomoon-icon-list-view"></span>
                            <span class="txt">Nueva receta</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Realiza un nuevo examen" class="tipB">
                            <span class="icon cut-icon-checkbox-checked"></span>
                            <span class="txt">Nuevo examen</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Agregar el paciente a lista de espera" class="tipB">
                            <span class="icon icomoon-icon-clock"></span>
                            <span class="txt">En espera</span>
                        </a>
                    </li>
                </ul>
                <ul class="bigBtnIcon">
                    <li>
                        <a href="#" title="Ver el historial de consultas" class="tipB">
                            <span class="icon wpzoom-medicine"></span>
                            <span class="txt">Historial de consultas</span>
                            <span class="notification green">0</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Ver el historial de citas" class="tipB">
                            <span class="icon icomoon-icon-calendar"></span>
                            <span class="txt">Historial de citas</span>
                            <span class="notification green">0</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Ver el historial de recetas" class="tipB">
                            <span class="icon icomoon-icon-list-view"></span>
                            <span class="txt">Historial de recetas</span>
                            <span class="notification green">0</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Ver el historial de examenes" class="tipB">
                            <span class="icon cut-icon-checkbox-checked"></span>
                            <span class="txt">Historial de examenes</span>
                            <span class="notification green">0</span>
                        </a>
                    </li>
                </ul>
            </div>

        </fieldset>

        <fieldset>
            <legend>Actividad</legend>
        </fieldset>


    </div>

</div>