<div class="row-fluid">

    <div class="span12">

        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Usuarios por empresa</span>
                </h4>
            </div>
            <div class="content noPad clearfix">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th>Persona</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(count($usuarios) > 0)
                    {
                        foreach($usuarios as $row)
                        {
                            ?>
                            <tr>
                                <td><?= $row->persona?></td>
                                <td><?= $row->usr_login?></td>
                                <td><?= $row->rol_titulo?></td>
                                <td>d</td>
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