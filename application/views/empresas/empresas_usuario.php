<?php
$return = base64_encode(site_url());
$emp_id = getEmpresaId();
?>
<div class="row-fluid">
    <div class="span12">
<table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
    <thead>
    <tr>
        <th>Razon social</th>
        <th>NIT</th>
        <th>Predeterminada</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($empresas as $row){
    if($emp_id == $row->emp_id)
    $estado = 1;
    else
    $estado = 0;

    echo '<tr><td>'.$row->emp_razon_social.'</td><td>'.$row->emp_nit.'</td><td>'.setCheckIcon(site_url('empresas/setPredetermianda/'.$row->emp_id.'/'.$return),$estado).'</td></tr>';
    }
    ?>
</tbody>
</table>
    </div>
    </div>