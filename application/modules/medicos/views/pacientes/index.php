<div class="row-fluid">

    <div class="span12">

        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Pacientes</span>
                </h4>
            </div>
            <div class="content noPad clearfix">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" id="listaClientes" width="100%">
                    <thead>
                    <tr>
                        <th class="span3">Codigo empleado</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th class="span3">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($pacientes))
                    {
                        foreach($pacientes as $row)
                        {
                            ?>
                            <tr>
                                <td><a href="<?= site_url('medicos/pacientes/perfil/'.$row->pac_key)?>"><?= $row->pac_codigo_paciente?></a></td>
                                <td><?=  $row->pac_primer_nombre.' '.$row->pac_segundo_nombre?></td>
                                <td><?=  $row->pac_primer_apellido.' '.$row->pac_segundo_apellido?></td>
                                <td class="text-center">
                                    <form class="box-form" action="">
                                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                            <span class="icon16 icomoon-icon-cog-2"></span>
                                            Opciones
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?= site_url('medicos/pacientes/perfil/'.$row->pac_key)?>"><span class="icon-picture"></span> Perfil</a></li>
                                            <li><a href="<?= site_url('medicos/consultas/seleccion_form/'.$row->pac_key)?>"><span class="wpzoom-medicine"></span> Realizar consulta</a></li>
                                            <li><a href="<?= site_url('consultas/seleccion_form/'.$row->pac_key)?>"><span class="icon-time"></span> En espera</a></li>
                                            <li><a href="#"><span class="icon-pencil"></span> Editar</a></li>
                                            <li><a href="#"><span class="icon-trash"></span> Eliminar</a></li>
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