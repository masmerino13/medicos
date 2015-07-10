<table class="responsive table table-bordered dynamicTable span12" id="lista_roles" >
    <thead>
    <tr>
        <th>Rol</th>
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(count($roles) > 0){
        foreach($roles as $row)
        {
            ?>
            <tr label="<?= $row->rol_titulo ?>" value="<?= $row->rol_id?>">
                <td><?= $row->rol_titulo?></td>
                <td><?= $row->rol_estado ?></td>
            </tr>
        <?php
        }
    }
    ?>
    </tbody>
</table>