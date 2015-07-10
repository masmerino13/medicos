<table class="responsive table table-bordered dynamicTable span12" id="lista_personal" >
    <thead>
    <tr>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Dui</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(count($personal) > 0){
        foreach($personal as $row)
        {
            ?>
            <tr label="<?= $row->per_primer_nombre.' '.$row->per_segundo_nombre?>" value="<?= $row->per_id?>">
                <td><?= $row->per_primer_nombre.' '.$row->per_segundo_nombre?></td>
                <td><?= $row->per_primer_apellido.' '.$row->per_segundo_apellido?></td>
                <td><?= $row->per_dui?></td>
            </tr>
        <?php
        }
    }
    ?>

    </tbody>
</table>