<div class="content">
    <?php
    $attributes = array('id' => 'adminFormContables');
    echo form_open('facturacion/vendedores/perfil/'.$vxe_id,$attributes)
    ?>

    <div class="span6">
        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3">Sucursal:</label>
                <div class="span7 left">
                    <select id="vxe_id_src" name="vxe_id_src" >
                        <option value="0">Todas las sucursales</option>
                        <?php
                        if(!empty($sucursales))
                        {
                            foreach($sucursales as $row)
                            {
                                echo '<option value="'.$row->src_id.'">'.$row->src_descripcion.'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

            </div>

            <div class="row-fluid">
                <label class="form-label span3">Punto de venta:</label>
                <div class="span7 left" id="puntos_sucursal">
                    <select name="efa_id_pve" >
                        <option value="0">Todos los puntos</option>
                    </select>
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
    <input type="hidden" id="base_url" value="<?= base_url()?>">
    <?php
    echo form_hidden('vxe_id',$vxe_id);
    echo form_hidden('tipo',2);
    echo form_close();
    ?>

</div>