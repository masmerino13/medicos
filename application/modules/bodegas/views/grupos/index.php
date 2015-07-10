<div class="row-fluid">

    <div class="span12">

        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Grupos</span>
                </h4>
            </div>
            <div class="content noPad clearfix">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" id="listaBodegas" width="100%">
                    <thead>
                    <tr>
                         <th>Descripción</th>
                    
                         <th>id empresa</th>
                          <th>id parent</th>
                     
                       
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($grupos))
                    {
                        foreach($grupos as $row)
                        {
                            ?>
                            <tr label="<?= $row->grp_descripcion ?>" value="<?= $row->grp_id?>">
                                <td><?= $row->grp_descripcion?></td>
                                <td><?=  $row->grp_id_emp?></td>
                                <td><?= $row->grp_parent ?></td>
                               
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