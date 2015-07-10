

<div class="span12">
    <?php
    $attributes = array('id' => 'adminForm');
    echo form_open('facturacion/clientes/nacional_natural',$attributes)
    ?>

    <div class="span6">
        

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span1" for="rol">D.C</label>
                <div class="span6 left" id="faxArea" style="margin-left: 0">
                    <input class="span8 left" name="farea[]" type="text" />
                   
                </div>
               
            </div>
        </div>


         <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span1" for="rol">NIT</label>
                <div class="span6 left" id="faxArea" style="margin-left: 0">
                    <input class="span8 left" name="farea[]" type="text" />
                  
                </div>
                
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
<input type="hidden" name="dgn_id_cli" value="<?= $cliente[0]->cli_id?>">
    <?php
    echo form_close();


    /*NAURAL EXTRANJERO*/
    ?>
</div>



