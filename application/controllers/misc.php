<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Misc extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('misc_model','misc');
    }

    function municipios()
    {
        $depto =  trim($_POST['depto']);
        $municipios = $this->misc->getMnicipiosPorDepartamento($depto);

        echo '<select name="dgn_municipio">';
        if(count($municipios) > 1){
        echo '<option value="">Seleccionar</option>';
        foreach($municipios as $mun)
        {
            echo '<option value="'.$mun->reg_id.'">'.$mun->reg_descripcion.'</option>';
        }
        }else{
            echo '<option value="">Seleccionar</option>';
    }
        echo '</select>';

    }
}