<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 5/4/14
 * Time: 4:28 PM
 */
class Misc_model extends CI_Model
{
    var $tabla = 's_gen_reg_region';
    var $id = 'reg_id';

    function getDepartamentos()
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla);
        $this->db->where('reg_nivel','1');
        $query = $this -> db -> get();

        if($query -> num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    function getMnicipiosPorDepartamento($depto)
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla);
        $this->db->where('reg_nivel','2');
        $this->db->where('reg_padre',$depto);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
}