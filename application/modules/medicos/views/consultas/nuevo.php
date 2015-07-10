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
                        <th>Opciones</th>
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
                                <td><a href="<?= site_url('medicos/consultas/seleccion_form/'.$row->pac_key)?>"><?= $row->pac_codigo_paciente?></a></td>
                                <td><?=  $row->pac_primer_nombre.' '.$row->pac_segundo_nombre?></td>
                                <td><?=  $row->pac_primer_apellido.' '.$row->pac_segundo_apellido?></td>
                                <td><a href="<?= site_url('medicos/consultas/seleccion_form/'.$row->pac_key)?>" class="btn">Realizar consulta medica</a></td>
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