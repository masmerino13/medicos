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
                        <th>Empresa</th>
                        <th>Estado</th>
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
                                <td><?=  $row->bod_id_emp?></td>
                                <td><?= $row->bod_estado ?></td>
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