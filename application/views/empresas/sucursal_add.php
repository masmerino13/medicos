<div class="box ">
    <div class="title">
        <h4>
            <span class="icon16 icomoon-icon-equalizer-2"></span>
            <span>Registrar punto de venta</span>
        </h4>
        <a href="#" class="minimize">Minimize</a>
    </div>
    <?php echo validation_errors(); ?>
    <div class="content">
        <?php
        $attributes = array('id' => 'form-validate','novalidate'=>'novalidate');
        echo form_open('empresas/sucursal/'.$src_id,$attributes)
        ?>

        <div class="span6">
            <div class="form-field-box even">
                <div class="row-fluid">
                    <label class="form-label span3" for="pve_descripcion">Descripción</label>
                    <input class="span8 required" id="pve_descripcion" name="pve_descripcion" type="text" />
                </div>
            </div>

            <div class="form-field-box odd">
                <div class="row-fluid">
                    <label class="form-label span3" for="multiUsusario">Usuarios</label>
                    <select multiple class="nostyle span8" name="multiUsusario[]">
                        <?php
                        foreach($usuarios as $usr)
                        {
                          echo '<option value="'.$usr->usr_id.'" >'.$usr->persona.'</option>';
                        }
                        ?>
                    </select>
                    <span class="help-block blue span8">Estos seran los encargados de facturar en este punto de venta</span>
                </div>
            </div>

            <div class="clear"></div>

            <div class="pDiv">
                <p>
                    <?= back(). form_button(array('content'=>'<span class="icon16 icomoon-icon-checkmark white"></span>'.SIIE_BTN_SAVE,'class'=>'btn btn-success','type'=>'submit'))?>
                </p>

            </div>

        </div>
        <input type="hidden" name="tipo" value="2">
        <?php
        echo form_close();
        ?>

    </div>
    <!-- End .box -->

</div>