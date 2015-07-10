<div class="row-fluid">
    <div class="span12">

        <div class="box ">
            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Registrar nuevo vendedor</span>
                </h4>
            </div>
            <?php echo validation_errors(); ?>
            <div class="content">
                <?php
                $attributes = array('id' => 'adminForm');
                echo form_open('facturacion/vendedores/nuevo',$attributes)
                ?>

                <div class="span6">
                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3">Empresa</label>
                            <input class="span7 left validate[required]" type="text" value="<?= $empresa[0]->emp_razon_social?>" readonly />
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="cli_codigo">Codigo vendedor</label>
                            <input class="span7 left validate[required,maxSize[20]]" id="vxe_codigo_vendedor" name="vxe_codigo_vendedor" type="text" />
                        </div>
                    </div>

                    <div class="form-field-box odd">
                        <div class="row-fluid">
                            <label class="form-label span3" for="emp_desc">Empleado</label>
                            <input class="span7 left validate[required]" id="emp_desc" type="text" readonly />
                            <a class="btn marginR10 marginB10" id="openDialogEmpleados" >...</a>
                        </div>
                    </div>

                    <div class="clear"></div>

                    <div class="pDiv">
                        <p>
                            <input type="hidden" id="vxe_id_emp" name="vxe_id_emp" value="0">
                            <?= form_button(array('content'=>'<span class="icon16 icomoon-icon-checkmark white"></span>'.SIIE_BTN_SAVE,'class'=>'btn btn-success','type'=>'submit'))?>
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

<div id="personalModal">
    <?php
    $this->load->view('empleados/personal_modal');
    ?>
</div>