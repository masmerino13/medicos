<div class="row-fluid">

    <div class="span12">

        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Bodegas empresa</span>
                </h4>
            </div>
            <div class="content noPad clearfix">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" id="listaBodegas" width="100%">
                    <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($bodegas))
                    {
                        foreach($bodegas as $row)
                        {
                            ?>
                            <tr label="<?= $row->bod_descripcion ?>" value="<?= $row->bod_id?>">
                                <td><?= $row->bod_descripcion?></td>
                                <td><?= $row->bod_estado ?></td>
                                <td>
                                    <div class='tools'>
                                        <div class="btn-group">
                                            <button class="btn">Acciones</button>
                                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a custom="#" href="<?= site_url('bodegas/bodegas/articulos/'.$row->bod_id)?>" class="acciones" title="Articulos">
                                                        <span class="icon16 icomoon-icon-bag"></span>
                                                        Articulos
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
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