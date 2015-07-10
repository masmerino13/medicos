


<div class="span5">
    <?php
    $attributes = array('id' => 'adminFormFicales');
    echo form_open('facturacion/clientes/nacional_natural',$attributes)
    ?>

    <div class="span10">
        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span2" for="dfn_nrc">NRC</label>
                <input class="span7 left validate[required]" id="dfn_nrc" name="dfn_nrc" type="text" />
            </div>
        </div>

            <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span2" for="dfn_nit">NIT</label>
                <div class="span9 left" id="dfn_nit" style="margin-left: 0">
                    <input class="span9 left validate[required]" name="dfn_nit" type="text" />
                </div>
            </div>
        </div>

    <div class="row-fluid">

    <label class="form-label span6" for="checkboxes">Tipos de ventas:</label>
    
    <div class="span12 controls">

        <div class="span6">
            <div class="left marginT5">
                <div id="uniform-undefined" class="checker">
                    <span class="">
                        <input style="opacity: 0;" name="chk_ve" value="1" class="styled" type="checkbox">
                    </span>
                </div>
                Ventas Excentas
            </div>
            <div class="left marginT5">
                <div id="uniform-undefined" class="checker">
                    <span class="">
                        <input style="opacity: 0;" name="chk_vs" value="1" class="styled" type="checkbox">
                    </span>
                </div>
                Ventas No sujeto
            </div>
            <div class="left marginT5">
                <div id="uniform-undefined" class="checker">
                    <span class="">
                        <input style="opacity: 0;" name="chk_vtc" value="1" class="styled" type="checkbox">
                    </span>
                </div>
                Ventas Tasa Cero
            </div>
        </div>
        <div class="span6">
            <div class="left marginT5">
                <div id="uniform-undefined" class="checker">
                    <span class="">
                        <input style="opacity: 0;" name="chk_vri" value="1" class="styled" type="checkbox">
                    </span>
                </div>
                Ventas Ret. de iva
            </div>
            <div class="left marginT5">
                <div id="uniform-undefined" class="checker">
                    <span class="">
                        <input style="opacity: 0;" name="chk_vrpc" value="1" class="styled" type="checkbox">
                    </span>
                </div>
                Ventas Rt.P.a cuenta.
            </div>
            <div class="left marginT5">
                <div id="uniform-undefined" class="checker">
                    <span class="">
                        <input style="opacity: 0;" name="chk_vg" value="1" class="styled" type="checkbox">
                    </span>
                </div>
                Ventas Grabadas
            </div>
        </div>

    </div>
    
</div>



       


        <div class="clear"></div>

        <div class="pDiv">
            <p>
                <?= form_button(array('content'=>'<span class="icon16 icomoon-icon-checkmark white"></span>'.SIIE_BTN_SAVE,'class'=>'btn btn-success marginT5','type'=>'submit'))?>
            </p>

        </div>

    </div>

<input type="hidden" id="base_url" value="<?= site_url()?>">
<input type="hidden" name="dgn_id_cli" value="<?= $cliente[0]->cli_id?>">
<input type="hidden" name="tipo" value="2">
    <?php
    /*NACIONAL NACIONAL*/
    echo form_close();
    ?>
</div>


