<div class="row-fluid">

    <div class="span12">

        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Periodos fiscales</span>
                </h4>
            </div>
            <div class="content noPad clearfix">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th>Año</th>
                        <th>Mes</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($periodos))
                    {
                        foreach($periodos as $row)
                        {
                            ?>
                            <tr>
                                <td><?= $row->pef_anio?></td>
                                <td><?= $row->pef_mes?></td>
                                <td><?= setCheckIcon(site_url('periodo_fiscal/setPeriodoFiscal/'.$row->pef_id),$row->pef_estado)?></td>
                                <td></td>
                            </tr>
                        <?php
                        }

                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>