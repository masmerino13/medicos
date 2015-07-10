



<div class="span12">
    <?php
    $attributes = array('id' => 'adminForm');
    echo form_open('facturacion/clientes/nacional_natural',$attributes)
    ?>

    <div class="span6">
        <div class="form-field-box odd">



 <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="rol">Tipo de pago</label>
                <div class="span7 left" style="margin-left: 0">
                    <select id="depto">
                        <option>Tipo de pago</option>
                        <?php
                        foreach($departamentos as $depto){
                        ?>
                        <option value="<?= $depto->reg_id?>"><?= $depto->reg_descripcion?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>


         <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="rol">Clacificacion Crediticia</label>
                <div class="span7 left" style="margin-left: 0">
                    <select id="depto">
                        <option>Clacificacion Crediticia</option>
                        <?php
                        foreach($departamentos as $depto){
                        ?>
                        <option value="<?= $depto->reg_id?>"><?= $depto->reg_descripcion?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

         <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="rol">Vendedor</label>
                <div class="span7 left" style="margin-left: 0">
                    <select id="depto">
                        <option>Vendedor</option>
                        <?php
                        foreach($departamentos as $depto){
                        ?>
                        <option value="<?= $depto->reg_id?>"><?= $depto->reg_descripcion?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

         <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="rol">Cobrador</label>
                <div class="span7 left" style="margin-left: 0">
                    <select id="depto">
                        <option>Cobrador</option>
                        <?php
                        foreach($departamentos as $depto){
                        ?>
                        <option value="<?= $depto->reg_id?>"><?= $depto->reg_descripcion?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>


         <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="rol">Zona Geografia</label>
                <div class="span7 left" style="margin-left: 0">
                    <select id="depto">
                        <option>Zona Geografica</option>
                        <?php
                        foreach($departamentos as $depto){
                        ?>
                        <option value="<?= $depto->reg_id?>"><?= $depto->reg_descripcion?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>





            <div class="row-fluid">
                <label class="form-label span3" for="dgn_dui">Limite de Credito</label>
                <input class="span7 left validate[required]" id="dgn_dui" name="dgn_dui" type="text" />
            </div>


             <div class="row-fluid">
                <label class="form-label span3" for="dgn_dui">Dias de Plazo</label>
                <input class="span7 left validate[required]" id="dgn_dui" name="dgn_dui" type="text" />
            </div>

             <div class="row-fluid">
                <label class="form-label span3" for="dgn_dui">Dias de Gracia</label>
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
<input type="hidden" name="dgn_id_cli" value="<?= $cliente[0]->cli_id?>">
    <?php
    echo form_close();

    //NACIONAL NACIONAL
    ?>
</div>