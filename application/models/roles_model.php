<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/16/14
 * Time: 3:11 PM
 */
class Roles_model extends CI_Model
{
    var $tabla = 's_rol_roles';
    var $id = 'rol_id';

    function getRoles()
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla);
        $this -> db -> where('rol_estado', 1);

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

    function getRol($rol_id)
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla);
        $this -> db -> where($this->id, $rol_id);
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

    function insertaMenu($post)
    {
        $data = array(
            'ixm_id_mod' => $post['ixm_id_mod'],
            'ixm_titulo' => $post['ixm_titulo'],
            'ixm_link' => $post['ixm_link'],
            'ixm_parent' => $post['ixm_parent']
        );

        if($this->db->insert('s_ixm_itemsxmodulo', $data))
        {
            return true;
        }else{
            return false;
        }
    }

    function getValidaItemModuloPorRol($rol_id,$item_id)
    {
        $this -> db -> select('COUNT(axr_id_ixm) AS n')
                    -> from('s_axr_accesosxrol')
                    -> where(array('axr_id_rol'=> $rol_id, 'axr_id_ixm' => $item_id));

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

    function getValidaPermisosModuloPorRol($rol,$modulo)
    {
        $this -> db -> select(" COALESCE(axr_borrar, 0) AS borrar, coalesce(axr_crear,0) AS crear, coalesce(axr_editar,0) AS editar",false)
                    -> from('s_axr_accesosxrol')
                    -> join('s_ixm_itemsxmodulo','ixm_id = axr_id_ixm')
                    -> join('s_mod_modulos','mod_id = ixm_id_mod')
                    -> where(array('mod_id'=> $modulo, 'axr_id_rol' => $rol));

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

    function eliminaAccesosPorRol($rol_id)
    {
        $this->db->delete('s_axr_accesosxrol', array('axr_id_rol' => $rol_id));
    }

    function insertaAccesosPorRol($data)
    {
        $this->db->insert('s_axr_accesosxrol', $data);
    }
}