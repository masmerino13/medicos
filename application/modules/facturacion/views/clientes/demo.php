ESto es <?php
$n = count($valor);
/*
foreach($valor as $k => $v)
{
    echo $k.' = '.$valor[$k].'<br>';
}
*/
$otroarray = array(
    'nit' => $valor['dfn_nit'],
    'nrc' => $valor['dfn_nrc'],
);

print_r($otroarray);
?>