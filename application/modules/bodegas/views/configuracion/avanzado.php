<div class="content">
    <?php
    $attributes = array('id' => 'adminForm');
    echo form_open('facturacion/configuracion/guardar',$attributes)
    ?>

    <div class="span6">
        <?php
        foreach($config_general as $row)
        {
            $valor = "";
            if(!empty($config_empresa)){
                foreach($config_empresa as $key => $c):
                    if($key == $row->cxm_cons):
                        $valor = $config_empresa[$key];
                        break;
                    endif;
                endforeach;
            }

            $element = str_replace(' ','_',$row->cxm_label);
          echo '<div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="cli_codigo">'.$row->cxm_label.'</label>
                            <input class="span7 left" id="'.$element.'" name="element['.$row->cxm_id.']" value="'.$valor.'" placeholder="'.$row->cxm_ayuda.'" type="text" />
                        </div>
                    </div>';
        }
        ?>

        <div class="clear"></div>

        <div class="pDiv">
            <p>
                <?= form_button(array('content'=>'<span class="icon16 icomoon-icon-checkmark white"></span>Guardar config. avanzada','class'=>'btn btn-success','type'=>'submit'))?>
            </p>

        </div>

    </div>

    <?php
    echo form_hidden('tipo','1');
    echo form_close();
    ?>

</div>