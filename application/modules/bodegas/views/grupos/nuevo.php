<div class="row-fluid">
    <div class="span12">

        <div class="box ">
            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Registrar nuevo Grupo</span>
                </h4>
            </div>
            <?php echo validation_errors(); ?>
            <div class="content">
                <?php
                $attributes = array('id' => 'adminForm');
                echo form_open('bodegas/grupos/nuevo',$attributes)
                ?>

                <div class="span6">
                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="grp_descripcion">Descripcion:</label>
                            <input class="span7 left" id="grp_descripcion" name="grp_descripcion" type="text" />
                        </div>
                    </div>

    <div class="span6">
        <div class="row-fluid">
            <label class="form-label span3" for="combobox">Nivel:</label>
            <div class="span4 controls sel">
                <select class="nostyle required" id="combobox" name="grp_parent">
                    <option value="0">Nivel Superior</option>
                    <?php
                    if(!empty($grupos)){
                        foreach($grupos as $row)
                        {
                            echo '<option value="'.$row->grp_id.'">'.$row->grp_descripcion.'</option>';
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>



                    <div class="clear"></div>

                    <div class="pDiv">
                        <p>
                            <?= form_button(array('content'=>'<span class="icon10 icomoon-icon-checkmark white"></span>'.SIIE_BTN_SAVE,'class'=>'btn btn-success','type'=>'submit'))?>
                            <?= back() ?>
                        </p>

                    </div>

                </div>

                <?php
                echo form_close();
                ?>

            </div>
            <!-- End .box -->

        </div>
    </div>
</div>