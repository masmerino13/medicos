<div class="row-fluid">

    <div class="span12">

        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Consultas realizadas</span>
                </h4>
            </div>
            <div class="content noPad clearfix">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" id="listaClientes" width="100%">
                    <thead>
                    <tr>
                        <th class="span2">Correlativo</th>
                        <th class="span3">Codigo paciente</th>
                        <th>Paciente</th>
                        <th class="span2">Fecha</th>
                        <th class="span3">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($consultas))
                    {
                        foreach($consultas as $row)
                        {
                            ?>
                            <tr>
                                <td><a href="<?= site_url('medicos/consultas/seleccion_form/'.$row->eco_id)?>"><?= $row->eco_codigo_consulta?></a></td>
                                <td><?= $row->pac_codigo_paciente?></td>
                                <td><?=  $row->pac_nombre?></td>
                                <td><?=  $row->eco_fecha_consulta?></td>
                                <td>
                                    <form class="box-form" action="">
                                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                            <span class="icon16 icomoon-icon-cog-2"></span>
                                            Opciones
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?= site_url('medicos/pacientes/perfil/'.$row->eco_id)?>"><span class="icon-list"></span> Detalle</a></li>
                                            <li><a href="<?= site_url('medicos/pacientes/perfil/'.$row->eco_id)?>"><span class="icon-user"></span> Ver ficha del cliente</a></li>
                                        </ul>
                                    </form>
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