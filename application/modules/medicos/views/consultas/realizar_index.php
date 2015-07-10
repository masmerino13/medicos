<div class="row-fluid alert-info" style="padding: 5px">
    <div class="span4">
        <div class="form-field-box even">
            <div class="row-fluid">
                <label class="form-label span3 text-left" style="text-align: left" for="fxc_titulo">Paciente:</label>
                <?= $paciente[0]->nombre_completo?>
                </div>
        </div>
    </div>
    <div class="span4">
        <div class="form-field-box even">
            <div class="row-fluid">
                <label class="form-label span3 text-left" style="text-align: left" for="fxc_titulo">Codigo:</label>
                <?= $paciente[0]->pac_codigo_paciente?>
                </div>
        </div>
    </div>
    <div class="span4">
        <div class="form-field-box even">
            <div class="row-fluid">
                <label class="form-label span2 text-left" style="text-align: left" for="fxc_titulo">Edad:</label>
                <?= $paciente[0]->edad?> años
                </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <?php
    $this->load->view('consultas/realizar_form');
    ?>
</div>

<div id="ficha-paciente-modal">
    <?php
    $this->load->view('consultas/realizar_ficha');
    ?>
</div>

<div id="historial-modal">
    <?php
    $this->load->view('consultas/realizar_historial');
    ?>
</div>
