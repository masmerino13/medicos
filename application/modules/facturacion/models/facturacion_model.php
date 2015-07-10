<?php
/**
* Created by PhpStorm.
* User: Ricardo
* Date: 3/16/14
* Time: 3:11 PM
*/
class Facturacion_model extends CI_Model
{    

    function get_tabla($tabla,$where=null,$order=null)
    {
        $this->db->select()
        ->from($tabla);

        if ($where != null) {
            $this->db->where($where);
        }

        if($order != null) {
            $this->db->order_by($order);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    function insertar($tabla,$campos)
    {
        $this->db->insert($tabla,$campos);
        return $this->db->insert_id();
    }

    function actualizar($tabla,$set,$where)
    {
        $this->db->where($where);
        $this->db->update($tabla, $set);        
        return 1;
    }    

    function getItemPorModulo($mod_id)
    {
        $this -> db -> select('*');
        $this -> db -> from('s_ixm_itemsxmodulo');
        $this -> db -> where('ixm_id_mod', $mod_id);

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