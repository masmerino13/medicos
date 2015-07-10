<div class="span12">

<div class="box closed">

<div class="title">
    <h4>
        <span class="icon16 icomoon-icon-equalizer-2"></span>
        <span>Agregar item de menu</span>
    </h4>
    <a href="#" class="minimize">Minimize</a>
</div>
<div class="content">
    <?php
$attributes = array('id' => 'form-validate');
echo form_open('modulos/inserta_menu',$attributes)
?>

<div class="form-row row-fluid">
    <div class="span12">
        <div class="row-fluid">
            <label class="form-label span3">Modulo</label>
            <input class="span9" readonly value="<?= $mod[0]->mod_titulo?>" name="mod_titulo" type="text" />
        </div>
    </div>
</div>
<div class="form-row row-fluid">
    <div class="span12">
        <div class="row-fluid">
            <label class="form-label span3" for="ixm_titulo">Titulo</label>
            <input class="span9 required" id="ixm_titulo" name="ixm_titulo" type="text" />
        </div>
    </div>
</div>
<div class="form-row row-fluid">
    <div class="span12">
        <div class="row-fluid">
            <label class="form-label span3" for="ixm_link">Link</label>
            <input class="span9 required" id="ixm_link" name="ixm_link" type="text" />
        </div>
    </div>
</div>
<div class="form-row row-fluid">
    <div class="span12">
        <div class="row-fluid">
            <label class="form-label span3" for="ixm_icono">Icono</label>
            <input class="span9 required" id="ixm_icono" name="ixm_icono" type="text" />
        </div>
    </div>
</div>
<div class="form-row row-fluid">
    <div class="span12">
        <div class="row-fluid">
            <label class="form-label span3" for="combobox">Nivel</label>
            <div class="span9 controls sel">
                <select class="nostyle required" id="combobox" name="ixm_parent">
                    <option value="0">Nivel Superior</option>
                    <?php
                    if(count($items_modulo) > 0){
                        foreach($items_modulo as $row)
                        {
                            echo '<option value="'.$row->ixm_id.'">'.$row->ixm_titulo.'</option>';
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
            <label class="form-label span3" for="ixm_tipo">Tipo panel</label>
            <input type="checkbox" value="1" name="ixm_tipo" id="ixm_tipo">
        </div>
    </div>
</div>
<div class="form-row row-fluid">
    <div class="span12">
        <div class="row-fluid">
            <label class="form-label span3" for="ixm_estado">Activo</label>
            <input type="checkbox" value="1" name="ixm_estado" id="ixm_estado" checked>
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
echo form_hidden('ixm_id_mod',$mod_id);
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
                <span>Menu Modulo <?= $mod[0]->mod_titulo ?></span>
            </h4>
            <a href="#" class="minimize">Minimize</a>
        </div>
        <div class="content noPad">
            <table class="responsive table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Link</th>
                    <th>Parent</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(count($items_modulo) > 0){
                foreach($items_modulo as $row)
                {
                    ?>
                    <tr>
                        <td><?= $row->ixm_id?></td>
                        <td><?= $row->ixm_titulo?></td>
                        <td><?= $row->ixm_link?></td>
                        <td><?= $row->ixm_parent?></td>
                        <td>
                            <div class="controls center">
                                <a href="#" title="Editar" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                <a href="#" title="Remover" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                            </div>
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