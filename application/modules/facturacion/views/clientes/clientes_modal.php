<div class="row-fluid">

    <div class="span12">

        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Clientes empresa</span>
                </h4>
            </div>
            <div class="content noPad clearfix">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" id="listaClientes" width="100%">
                    <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre / razon social</th>
                        <th>Tipo cliente</th>
                        <th>Localizacion</th>
                        <th>Empresa</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($clientes))
                    {
                        foreach($clientes as $row)
                        {
                            ?>
                            <tr label="<?= $row->cli_nombre_razon_social ?>" value="<?= $row->cli_id?>">
                                <td><?= $row->cli_codigo?></td>
                                <td><?=  $row->cli_nombre_razon_social?></td>
                                <td><?= setTipoCliente($row->cli_tipo_cliente) ?></td>
                                <td><?= setTipoLocalizacion($row->cli_tipo_localizacion) ?></td>
                                <td><?= $row->emp_razon_social?></td>
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