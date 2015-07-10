<div class="row-fluid">
    <div class="span6">
        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="cli_id_src">Nombre:</label>
                <?= $vendedor[0]->nombre?>
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="cli_codigo">Codigo vendedor:</label>
                <?= $vendedor[0]->vxe_codigo_vendedor?>
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="cli_nombre_razon_social">Codigo empleado:</label>
                <?= $vendedor[0]->per_codigo_empleado?>
            </div>
        </div>
    </div>

    <div class="span6">
        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="cli_nombre_razon_social">DUI:</label>
                <?= $vendedor[0]->per_dui?>
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="cli_nombre_razon_social">NIT:</label>
                <?= $vendedor[0]->per_nit?>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <div style="margin-bottom: 20px;">
            <ul id="myTab" class="nav nav-tabs pattern">
                <li class="active"><a href="#contables" data-toggle="tab">Datos contables</a></li>
                <li><a href="#sucursales" data-toggle="tab">Sucursal</a></li>
                <li><a href="#config" data-toggle="tab">Configuración</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade in active" id="contables">
                    <?php $this->load->view('vendedores/perfil_contables');?>
                </div>
                <div class="tab-pane fade" id="sucursales">
                    <?php $this->load->view('vendedores/perfil_sucursal');?>
                </div>
                <div class="tab-pane fade" id="config">
                    <?php $this->load->view('vendedores/perfil_config');?>
                </div>
            </div>
        </div>

    </div>
</div>
