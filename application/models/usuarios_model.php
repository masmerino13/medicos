<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/29/14
 * Time: 9:38 PM
 */
class Usuarios_Model extends CI_Model
{
    var $tabla = 's_usr_usuarios';
    var $uxe_usuarioxempresa = 's_uxe_usuariosxempresa';
    var $id = 'usr_id';

    function getUsuarios($emp_id)
    {
        $sql = "CALL s_sp_usuarios_por_empresa(?)";
        $param = array($emp_id);
        $query = $this->db->query($sql,$param);

        if(($query) && ($query->num_rows() > 0))
        {
            $result = $query->result();
        }
        else
            $result = false;

        $query->next_result(); // Dump the extra resultset.
        $query->free_result();

        return $result;
    }

    function insertaUsuario($data)
    {
        $this->db->insert($this->tabla,$data);
        return $this->db->insert_id();
    }

    function insertaUsuarioPorEmpresa($data)
    {
        $this->db->insert($this->uxe_usuarioxempresa,$data);
    }

    function insertaUsuarioPorPersona($data)
{
    $this->db->insert($this->s_uxp_usuariosxpersonas,$data);
}
}