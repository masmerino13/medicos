<div class="content">
    <?php
    $attributes = array('id' => 'adminFormContables');
    echo form_open('facturacion/vendedores/perfil/'.$vxe_id,$attributes)
    ?>

    <div class="span6">
        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3">Cuenta por cobrar:</label>
                <input class="span7 left validate[required]" id="vxe_cuenta_cobrar" name="vxe_cuenta_cobrar" type="text" />
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="cli_codigo">Cuenta por pagar:</label>
                <input class="span7 left validate[required]" id="vxe_cuenta_pagar" name="vxe_cuenta_pagar" type="text" />
            </div>
        </div>

        <div class="clear"></div>

        <div class="pDiv">
            <p>
                <input type="hidden" id="vxe_id_emp" name="vxe_id_emp" value="0">
                <?= form_button(array('content'=>'<span class="icon16 icomoon-icon-checkmark white"></span>'.SIIE_BTN_SAVE,'class'=>'btn btn-success','type'=>'submit'))?>
            </p>

        </div>

    </div>

    <?php
    echo form_close();
    ?>

</div>