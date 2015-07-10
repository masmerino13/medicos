<div class="row-fluid">

    <div class="span12">
        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Articulos</span>
                </h4>
            </div>
            <div class="content noPad clearfix">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th class="span5">Descripción</th>
                        <th class="span3">Codigo</th>
                        <th class="span2">Existencia</th>
                        <th class="span2">Precio Prom.</th>
                        <th class="span2">Monto</th>
                        <th class="span2">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($articulos))
                    {
                        foreach($articulos as $row)
                        {
                            ?>
                            <tr>
                                <td><?=  $row->art_descripcion?></td>
                                <td><?= $row->art_codigo_inventario ?></td>
                                <td><?= $row->axb_existencia ?></td>
                                <td><?= $row->art_precio_promedio?></td>
                                <td><?= $row->axb_monto?></td>
                                <td>...</td>
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