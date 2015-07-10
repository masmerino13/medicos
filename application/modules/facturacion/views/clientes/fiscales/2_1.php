


<div class="span5">
    <?php
    $attributes = array('id' => 'adminForm');
    echo form_open('facturacion/clientes/nacional_natural',$attributes)
    ?>

    <div class="span6">
        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span2" for="dgn_dui">NRC</label>
                <input class="span7 left validate[required]" id="dgn_dui" name="dgn_dui" type="text" />
            </div>
        </div>


        	<div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span2" for="rol">NIT</label>
                <div class="span9 left" id="telsArea" style="margin-left: 0">
                    <input class="span9 left" name="area[]" type="text" />
                   
                </div>
               
            </div>
        </div>





  



         <div class="row-fluid">

    <label class="form-label span9" for="checkboxes">TIPOS DE VENTA:</label>
    
    <div class="span9 controls">
    
        
         <div class="left marginT5">
            <div id="uniform-undefined" class="checker"><span class=""><input style="opacity: 0;" name="optionsCheckboxList1" value="option1" class="styled" type="checkbox"></span></div>
            Ventas Excentas 
        </div>
         <div class="left marginT5">
            <div id="uniform-undefined" class="checker"><span class=""><input style="opacity: 0;" name="optionsCheckboxList1" value="option1" class="styled" type="checkbox"></span></div>
            Ventas No sujeto
        </div>
         <div class="left marginT5">
            <div id="uniform-undefined" class="checker"><span class=""><input style="opacity: 0;" name="optionsCheckboxList1" value="option1" class="styled" type="checkbox"></span></div>
            Ventas Tasa Cero
        </div>
         <div class="left marginT5">
            <div id="uniform-undefined" class="checker"><span class=""><input style="opacity: 0;" name="optionsCheckboxList1" value="option1" class="styled" type="checkbox"></span></div>
            Ventas Retencion de IVA
        </div>
         <div class="left marginT5">
            <div id="uniform-undefined" class="checker"><span class=""><input style="opacity: 0;" name="optionsCheckboxList1" value="option1" class="styled" type="checkbox"></span></div>
            Ventas Retencion de pago a cuenta
        </div>
 <div class="left marginT5">
            <div id="uniform-undefined" class="checker"><span class=""><input style="opacity: 0;" name="optionsCheckboxList1" value="option1" class="styled" type="checkbox"></span></div>
            Ventas Grabadas
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


//JURIDICO NACIONAL

    ?>
</div>


