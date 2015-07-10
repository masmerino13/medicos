<div class="row-fluid">
    <div class="span11">

        <div class="box">
            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Nuevo articulo en bodega</span>
                </h4>
            </div>
            <?php echo validation_errors(); ?>
            <div class="content">
                <?php
                $attributes = array('id' => 'admiForm');
                echo form_open('bodegas/bodegas/nuevo_articulo/'.$bod_id,$attributes)
                ?>

                <div class="span6">
                    <div class="form-field-box even">
                        <div class="row-fluid">
                            <label class="form-label span3" for="cliente">Bodega</label>
                            <input class="span7 left validate[required]" readonly id="bod_id" name="bod_id" value="<?= $bodega[0]->bod_descripcion?>" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box even">
                        <div class="row-fluid">
                            <label class="form-label span3" >Articulo</label>
                            <input class="span7 left validate[required]" readonly  id="art_desc" name="art_desc" placeholder="Selccionar articulo" type="text" />
                            <a class="btn marginR10 marginB10" id="openDialogArticulos" >...</a>
                        </div>
                    </div>

                    <div class="clear"></div>

                    <div class="pDiv marginT10">
                        <p>
                            <?= form_button(array('content'=>'<span class="icon16 icomoon-icon-checkmark white"></span>'.SIIE_BTN_SAVE,'class'=>'btn btn-success','type'=>'submit'))?>
                        </p>

                    </div>

                </div>

                <input type="hidden" name="bod_id" id="bod_id" value="<?= $bodega[0]->bod_id?>">
                <input type="hidden" name="art_id" id="art_id">
                <input type="hidden" id="base_url" value="<?= base_url()?>">

                <?php
                echo form_close();
                ?>

            </div>
            <!-- End .box -->

        </div>
    </div>
</div>

<div id="articulosModal">
    <?php $this->load->view('/bodegas/articulos_modal'); ?>
</div>