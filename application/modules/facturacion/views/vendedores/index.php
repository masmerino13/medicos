<div class="row-fluid">

    <div class="span12">
        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Vendedores</span>
                </h4>
            </div>
            <div class="content noPad clearfix">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th class="span3">Codigo vendedor</th>
                        <th>Nombre</th>
                        <th class="span3">Codigo empleado</th>
                        <th>Empresa</th>
                        <th class="span2">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($vendedores))
                    {
                        foreach($vendedores as $row)
                        {
                            ?>
                            <tr>
                                <td><?=  $row->vxe_codigo_vendedor?></td>
                                <td><a href="<?= site_url('facturacion/vendedores/perfil/'.$row->vxe_id)?>"><?= $row->nombre ?></a></td>
                                <td><?= $row->per_codigo_empleado ?></td>
                                <td><?= $row->emp_razon_social ?></td>
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