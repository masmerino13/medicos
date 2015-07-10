<div class="span12">
    <?php
    $attributes = array('id' => 'adminForm');
    echo form_open('empresas/sucursal/datos_generales',$attributes)
    ?>

    <div class="span6">
        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="dgn_dui">C.C Venta al contado:</label>
                <input class="span7 left validate[required]" id="dgn_dui" name="dgn_dui" type="text" />
            </div>
        </div>

         <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="dgn_dui">C.C Venta al credito:</label>
                <input class="span7 left validate[required]" id="dgn_dui" name="dgn_dui" type="text" />
            </div>
        </div>
         <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="dgn_dui">C.C Anticipos de cliente:</label>
                <input class="span7 left validate[required]" id="dgn_dui" name="dgn_dui" type="text" />
            </div>
        </div>
         <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="dgn_dui">C.C Cuenta agena:</label>
                <input class="span7 left validate[required]" id="dgn_dui" name="dgn_dui" type="text" />
            </div>
        </div>


         <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="dgn_dui">C.C Cargos adicionales:</label>
                <input class="span7 left validate[required]" id="dgn_dui" name="dgn_dui" type="text" />
            </div>
        </div>


       

        <div class="clear"></div>

        <div class="pDiv">
            <p>
                <?= form_button(array('content'=>'<span class="icon16 icomoon-icon-checkmark white"></span>'.SIIE_BTN_SAVE,'class'=>'btn btn-success','type'=>'submit'))?>
            </p>

        </div>

    </div>
<input type="hidden" id="base_url" value="<?= site_url()?>">
    <?php
    echo form_close();
    ?>
</div>