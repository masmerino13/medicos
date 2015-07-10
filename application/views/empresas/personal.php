<div class="page-header">
    <h4>Empresa: <?= $empresa[0]->emp_razon_social?></h4>
</div>
<div class="row-fluid">
<div class="span11">

<div class="box closed">
<div class="title">
    <h4>
        <span class="icon16 icomoon-icon-equalizer-2"></span>
        <span>Registrar empleado empresa</span>
    </h4>
    <a href="#" class="minimize">Minimize</a>
</div>
<?php echo validation_errors(); ?>
<div class="content">
    <?php
    $attributes = array('id' => 'form-validate','novalidate'=>'novalidate');
    echo form_open('empresas/inserta_persona',$attributes)
    ?>

    <div class="span6">
        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3">Empresa</label>
                <input class="span8" readonly value="<?= $empresa[0]->emp_razon_social?>" name="mod_titulo" type="text" />
            </div>
        </div>

        <div class="form-field-box even">
            <div class="row-fluid">
                <label class="form-label span3" for="per_primer_nombre">Primer Nombre</label>
                <input class="span8 required" id="per_primer_nombre" name="per_primer_nombre" type="text" />
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="per_segundo_nombre">Segundo Nombre</label>
                <input class="span8 required" id="per_segundo_nombre" name="per_segundo_nombre" type="text" />
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="per_primer_apellido">Primer Apellido</label>
                <input class="span8 required" name="per_primer_apellido" id="per_primer_apellido" type="text" />
            </div>
        </div>

        <div class="form-field-box even">
            <div class="row-fluid">
                <label class="form-label span3" for="per_segundo_apellido">Segundo Apellido</label>
                <input class="span8 required" id="per_segundo_apellido" name="per_segundo_apellido" type="text" />
            </div>
        </div>

    </div>

    <div class="span6">

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="per_dui">DUI</label>
                <input class="span8 required dui" id="per_dui" name="per_dui" type="text" />
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="per_nit">NIT</label>
                <input class="span8 required nit" id="per_nit" name="per_nit" type="text" />
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="per_fecha_nacimiento">Fecha Nacimiento</label>
                <input class="span8 required datepicker" id="per_fecha_nacimiento" name="per_fecha_nacimiento" type="text" />
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="per_estado">Estado</label>
                <?= form_checkbox('per_estado',1)?>
            </div>
        </div>

    </div>

    <div class="clear"></div>

    <div class="pDiv">
        <p>
            <?= form_button(array('content'=>'<span class="icon16 icomoon-icon-checkmark white"></span>'.SIIE_BTN_SAVE,'class'=>'btn btn-success','type'=>'submit'))?>
        </p>

    </div>

    <?php
    echo form_hidden('emp_id',$emp_id);
    echo form_close();
    ?>

</div>
<!-- End .box -->

</div>
</div>
</div>
<!-- End .span12 -->

<div class="row-fluid">
    <div class="span11">

        <div class="box">

            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Personal registrado</span>
                </h4>
                <a href="#" class="minimize">Minimize</a>
            </div>
            <div class="content noPad">
                <table class="responsive table table-bordered">
                    <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Dui</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(count($personal) > 0){
                        foreach($personal as $row)
                        {
                            ?>
                            <tr>
                                <td><?= $row->per_primer_nombre.' '.$row->per_segundo_nombre?></td>
                                <td><?= $row->per_primer_apellido.' '.$row->per_segundo_apellido?></td>
                                <td><?= $row->per_dui?></td>
                                <td>
                                    <?php echo set_permiso_usuario(); ?>
                                </td>
                            </tr>
                        <?php
                        }
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
