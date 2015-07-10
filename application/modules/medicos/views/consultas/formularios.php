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
                <?= $paciente[0]->edad?>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">

    <div class="span12">

        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Formularios</span>
                </h4>
            </div>
            <div class="content noPad clearfix">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" id="listaClientes" width="100%">
                    <thead>
                    <tr>
                        <th class="span3">Titulo</th>
                        <th>Descripción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($forms))
                    {
                        foreach($forms as $row)
                        {
                            ?>
                            <tr>
                                <td><a href="<?= site_url('medicos/consultas/realizar/'.$pac_key.'/'.$row->fxc_id)?>"><?= $row->fxc_titulo?></a></td>
                                <td><?=  $row->fxc_descripcion?></td>
                            </tr>
                        <?php
                        }

                    }else{
                        echo '<tr><td colspan="3">Sin datos que mostrar</td></tr>';
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>