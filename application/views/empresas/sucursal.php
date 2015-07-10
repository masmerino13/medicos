<div class="row-fluid">
    <div class="span10">

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="cli_id_src">Correlativo</label>
                <?= setCorrelativoSucursal($sucursal[0]->scr_correlativo) ?>
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="cli_id_src">Descripción</label>
                <?= $sucursal[0]->src_descripcion?>
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="cli_codigo">Dirección</label>
                <?= $sucursal[0]->src_direccion?>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <div style="margin-bottom: 20px;">
            <ul id="myTab" class="nav nav-tabs pattern">
                <li class="active"><a href="#generales" data-toggle="tab">Datos Generales</a></li>
                <li><a href="#contables" data-toggle="tab">Datos Contables</a></li>
                <li><a href="#configuracion" data-toggle="tab">Configuración</a></li>
                <li><a href="#puntos" data-toggle="tab">Puntos de venta</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade in active" id="generales">
                    <?= $this->load->view('empresas/sucursal/datos_generales')?>
                </div>

                <div class="tab-pane fade in" id="contables">
                    <?= $this->load->view('empresas/sucursal/datos_contables')?>
                </div>

                <div class="tab-pane fade in" id="configuracion">
                    <?= $this->load->view('empresas/sucursal/configuracion')?>
                </div>

                <div class="tab-pane fade in" id="puntos">
                    <?= $this->load->view('empresas/sucursal_add');  ?>
                    <?= $this->load->view('empresas/sucursal_list');  ?>
                </div>
            </div>
        </div>

    </div>
</div>
