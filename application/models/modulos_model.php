<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/16/14
 * Time: 3:11 PM
 */
class Modulos_model extends CI_Model
{
    var $tabla = 's_mod_modulos';
    var $tabla_menu_modulo = 's_ixm_itemsxmodulo';
    var $id = 'mod_id';

    function getModulo($mod_id)
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla);
        $this -> db -> where($this->id, $mod_id);
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

    function getModulosList()
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla);
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

    function insertaMenu($post)
    {
        if(empty($post['ixm_tipo']))
            $post['ixm_tipo'] = 0;

        $data = array(
            'ixm_id_mod' => $post['ixm_id_mod'],
            'ixm_titulo' => $post['ixm_titulo'],
            'ixm_link' => $post['ixm_link'],
            'ixm_parent' => $post['ixm_parent'],
            'ixm_icono' => $post['ixm_icono'],
            'ixm_tipo' => $post['ixm_tipo'],
            'ixm_estado' => $post['ixm_estado']
        );

        if($this->db->insert($this->tabla_menu_modulo, $data))
        {
            return true;
        }else{
            return false;
        }
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

    function getItemMenuPorId($ixm_id)
    {
        $this -> db -> select('*');
        $this -> db -> from('s_ixm_itemsxmodulo');
        $this -> db -> where('ixm_id', $ixm_id);

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