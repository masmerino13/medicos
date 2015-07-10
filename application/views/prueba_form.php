<?php
echo form_open(site_url('prueba/nuevo'));
?>
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

                    <div class="span6">

                        <div class="form-field-box odd">
                            <div class="row-fluid">
                                <label class="form-label span3" for="nombre_completo">Nombres:</label>
                                <input class="span8" name="nombres" id="nombre_completo" type="text" />
                            </div>
                        </div>

                        <div class="form-field-box odd">
                            <div class="row-fluid">
                                <label class="form-label span3" for="apellidos">Apellidos:</label>
                                <input class="span8" name="apellidos" id="apellidos" type="text" />
                            </div>
                        </div>

                        <div class="form-field-box even">
                            <div class="row-fluid">
                                <label class="form-label span3" for="edad_persona">Fecha Nacimiento:</label>
                                <input class="span8 password" id="edad_persona" name="fecha_nac" type="text" />
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

                </div>
                <!-- End .box -->

            </div>
        </div>
    </div>
<?php
echo form_close();
?>

<div class="row-fluid">

    <div class="span12">

        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Pruebas</span>
                </h4>
            </div>
            <div class="content noPad clearfix">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered dataTable" width="100%">
                    <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Edad</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($pruebas as $pepe) {
                        $anio = date('Y') - $pepe->anio;
                        echo "<tr>
                            <td>".$pepe->nombres."</td>
                            <td>".$pepe->apellidos."</td>
                            <td>".$anio."</td>
                        </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

