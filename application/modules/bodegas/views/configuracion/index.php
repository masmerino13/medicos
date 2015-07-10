<div class="row-fluid marginB5">
    <?= back() ?>
</div>
<div class="row-fluid">
    <div class="span12">
        <div style="margin-bottom: 20px;">
            <ul id="myTab" class="nav nav-tabs pattern">
                <li class="active"><a href="#avanzado" data-toggle="tab">Avanzado</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade in active" id="avanzado">
                    <?php $this->load->view('configuracion/avanzado');?>
                </div>
            </div>
        </div>

    </div>
</div>
