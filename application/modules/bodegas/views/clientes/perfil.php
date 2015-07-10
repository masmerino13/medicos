<div class="row-fluid">
    <div class="span10">
        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="cli_id_src">Sucursal</label>
                <?= $cliente[0]->src_descripcion?>
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="cli_codigo">Codigo</label>
                <?= $cliente[0]->cli_codigo?>
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="cli_nombre_razon_social">Nombre o Razon social</label>
                <?= $cliente[0]->cli_nombre_razon_social?>
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="rol">Tipo cliente</label>
                <?= setTipoCliente($cliente[0]->cli_tipo_cliente) ?>
            </div>
        </div>

        <div class="form-field-box odd">
            <div class="row-fluid">
                <label class="form-label span3" for="rol">Localización</label>
                <?= setTipoLocalizacion($cliente[0]->cli_tipo_localizacion) ?>
            </div>
        </div>

    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <div style="margin-bottom: 20px;">
            <ul id="myTab" class="nav nav-tabs pattern">
                <li class="active"><a href="#generales" data-toggle="tab">Datos generales</a></li>
                <li><a href="#fiscales" data-toggle="tab">Datos fiscales</a></li>
                <li><a href="#crediticios" data-toggle="tab">Datos crediticios y cobro</a></li>
                <li><a href="#config" data-toggle="tab">Configuración</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade in active" id="generales">
                    <?php $this->load->view('clientes/generales/'.$cliente[0]->cli_tipo_cliente.'_'.$cliente[0]->cli_tipo_localizacion);?>
                </div>
                <div class="tab-pane fade" id="fiscales">
                    <?php $this->load->view('clientes/fiscales/'.$cliente[0]->cli_tipo_cliente.'_'.$cliente[0]->cli_tipo_localizacion);?>
                </div>
                <div class="tab-pane fade" id="crediticios">
                    <?php $this->load->view('clientes/crediticios/'.$cliente[0]->cli_tipo_cliente.'_'.$cliente[0]->cli_tipo_localizacion);?>
                </div>
                <div class="tab-pane fade" id="config">
                    <?php $this->load->view('clientes/crediticios/'.$cliente[0]->cli_tipo_cliente.'_'.$cliente[0]->cli_tipo_localizacion);?>
                </div>
            </div>
        </div>

    </div>
</div>
