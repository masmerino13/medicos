<div class="span12">
    <?php
    $attributes = array('id' => 'adminForm');
    echo form_open('facturacion/clientes/nacional_natural',$attributes)
    ?>

    <div class="span6">
      

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="rol">Puntos de Venta:</label>
                <div class="span7 left" style="margin-left: 0">
                    <select id="depto">
                        <option>Departamento</option>
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
                <label class="form-label span3" for="rol">Tipo de Cobrador:</label>
                <div class="span7 left" style="margin-left: 0" id="muni">
                    <select>
                        <option>Seleccioar</option>
                    </select>
                </div>
            </div>
        </div>

       


    <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="rol">Zona geografica</label>
                <div class="span7 left" style="margin-left: 0" id="muni">
                    <select>
                        <option>Seleccioar</option>
                    </select>
                </div>
            </div>
        </div>
	
	<div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="dgn_dui">Porcentage:</label>
                <input class="span4 left validate[required]" id="dgn_dui" name="dgn_dui" type="text" />
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