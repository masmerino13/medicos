<div class="span12">
    <?php
    $attributes = array('id' => 'adminForm');
    echo form_open('facturacion/clientes/nacional_natural',$attributes)
    ?>

    <div class="span6">
        <div class="form-field-box odd">
            
        </div>

        <div class="form-field-box odd">
           
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="dgn_direccion">Dirección</label>
                <input class="span7 left validate[required,maxSize[400]]" id="dgn_direccion" name="dgn_direccion" type="text" />
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="rol">Departamento</label>
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
                <label class="form-label span3" for="rol">Municipio</label>
                <div class="span7 left" style="margin-left: 0" id="muni">
                    <select>
                        <option>Seleccioar</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="rol">Correo electrónico</label>
                <div class="span6 left" id="correosArea" style="margin-left: 0">
                    <input class="span12" name="correo[]" type="text" />
                </div>
                <a id="addMails" class="btn" style="margin-bottom: 10px">+</a>
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="rol">Pagina web</label>
                <div class="span6 left" id="websArea" style="margin-left: 0">
                    <input class="span12" name="web[]" type="text" />
                </div>
                <a id="addWebs" class="btn" style="margin-bottom: 10px">+</a>
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="rol">Telefono</label>
                <div class="span6 left" id="telsArea" style="margin-left: 0">
                    <input class="span2 left" name="area[]" type="text" />
                    <input class="span10 left" name="telefono[]" type="text" />
                </div>
                <a id="addTel" class="btn" style="margin-bottom: 10px">+</a>
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="rol">Fax</label>
                <div class="span6 left" id="faxArea" style="margin-left: 0">
                    <input class="span2 left" name="farea[]" type="text" />
                    <input class="span10 left" name="fax[]" type="text" />
                </div>
                <a id="addFax" class="btn" style="margin-bottom: 10px">+</a>
            </div>


 <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="dgn_direccion">Gerente</label>
                <input class="span7 left validate[required,maxSize[400]]" id="dgn_direccion" name="dgn_direccion" type="text" />
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

</div>