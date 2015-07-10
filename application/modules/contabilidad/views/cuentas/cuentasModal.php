<style>
    .tree ul {
        list-style: none outside none;
    }
    .tree li a {
        line-height: 25px;
        cursor: pointer;
    }
    .tree li a:hover{
        color: #ff5a25;
    }
    .tree > ul > li > a {
        color: #3B4C56;
        display: block;
        font-weight: normal;
        position: relative;
        text-decoration: none;
    }
    .tree li.parent > a {
        padding: 0 0 0 28px;
    }
    .tree li.parent > a:before {
        background-image: url("../images/plus_minus_icons.png");
        background-position: 25px center;
        content: "";
        display: block;
        height: 21px;
        left: 0;
        position: absolute;
        top: 2px;
        vertical-align: middle;
        width: 23px;
    }
    .tree ul li.active > a:before {
        background-position: 0 center;
    }
    .tree ul li ul {
        border-left: 1px solid #D9DADB;
        /*display: none;*/
        margin: 0 0 0 12px;
        overflow: hidden;
        padding: 0 0 0 25px;
    }
    .tree ul li ul li {
        position: relative;
    }
    .tree ul li ul li:before {
        border-bottom: 1px dashed #E2E2E3;
        content: "";
        left: -20px;
        position: absolute;
        top: 12px;
        width: 15px;
    }
</style>
<div class="scroll" style="height:200px; overflow:auto; margin-top:10px;">
<div class="tree">
<?php
if(!empty($cuentas))
{

    $html = '<ul id="masterTree">';
    foreach($cuentas as $row)
    {
        if($row->n > 0)
            $icos = '<i class="icomoon-icon-plus-2"></i>';
        else
            $icos ='';

        if($row->ccc_detalle == 1)
            $icos .= '<i data-original-title="Cuenta de detalle" data-placement="bottom" rel="tooltip" class="minia-icon-list-2 "></i>';

        $html .= '<li>';
        $html .= '<a class="treeElement" pid="'.$row->ccc_cuenta.'">'.$icos.' '.$row->ccc_cuenta.' | '.$row->ccc_descripcion.'</a>';
        $html .= '<ul id="parent_'.$row->ccc_cuenta.'"></ul>';
        $html .= '</li>';
    }
    $html .= '</ul>';
    echo $html;
}
?>
<input type="hidden" id="base_url" value="<?= site_url()?>">
    </div>
    </div>
