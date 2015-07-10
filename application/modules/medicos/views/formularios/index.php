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
                        <th>Opciones</th>
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
                                <td><a href="<?= site_url('medicos/forms/elementos/'.$row->fxc_id)?>"><?= $row->fxc_titulo?></a></td>
                                <td><?=  $row->fxc_descripcion?></td>
                                <td></td>
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