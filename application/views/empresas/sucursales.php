<div class="page-header">
    <h4>Empresa: <?= $empresa[0]->emp_razon_social?></h4>
</div>
<div class="row-fluid">
<div class="span11">

<div class="box closed">
<div class="title">
    <h4>
        <span class="icon16 icomoon-icon-equalizer-2"></span>
        <span>Registrar sucursal</span>
    </h4>
    <a href="#" class="minimize">Minimize</a>
</div>
<?php echo validation_errors(); ?>
<div class="content">
    <?php
    $attributes = array('id' => 'form-validate','novalidate'=>'novalidate');
    echo form_open('empresas/sucursales/'.$emp_id,$attributes)
    ?>

    <div class="span6">

        <div class="form-field-box even">
            <div class="row-fluid">
                <label class="form-label span3" for="scr_correlativo">Correlativo</label>
                <input class="span8 required" id="scr_correlativo" name="scr_correlativo" value="<?= $correlativo ?>" type="text" />
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3">Empresa</label>
                <input class="span8" readonly value="<?= $empresa[0]->emp_razon_social?>" name="mod_titulo" type="text" />
            </div>
        </div>

        <div class="form-field-box even">
            <div class="row-fluid">
                <label class="form-label span3" for="src_descripcion">Descripción</label>
                <input class="span8 required validate[required]" id="src_descripcion" name="src_descripcion" type="text" />
            </div>
        </div>

    </div>

    <div class="span6">

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="src_direccion">Dirección</label>
                <textarea id="src_direccion" name="src_direccion" class="validate[required]" ></textarea>
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
    echo form_hidden('src_id_emp',$emp_id);
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
                    <span>Sucursales registradas</span>
                </h4>
                <a href="#" class="minimize">Minimize</a>
            </div>
            <div class="content noPad">
                <table class="responsive table table-bordered">
                    <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Dirección</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(count($sucursales) > 0){
                        foreach($sucursales as $row)
                        {
                            ?>
                            <tr>
                                <td><a href="<?= site_url('empresas/sucursal/'.$row->src_id)?>"><?= $row->src_descripcion?></a></td>
                                <td><?= $row->src_direccion?></td>
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
