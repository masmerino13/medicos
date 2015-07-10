<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 9/29/14
 * Time: 5:26 PM
 */
class Fac_Notas_Remision_Model extends CI_Model
{

    var $tabla = 's_fac_ecr_encabezado_remision';

    function getRemisionesByEmpresa($emp_id)
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla);
        $this -> db -> where($this->id, $emp_id);
        $this -> db -> limit(1);

        $query = $this -> db -> get();

        if($query -> num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
}