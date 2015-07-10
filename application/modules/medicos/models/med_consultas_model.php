<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 1/18/2015
 * Time: 11:06 PM
 */
class Med_Consultas_Model extends CI_Model
{
    function getConsultas()
    {
        $emp_id = getEmpresaId();
        $data = array($emp_id);
        $sql = "CALL s_sp_med_ver_consultas_consultorio(?)";

        $query = $this->db->query($sql,$data);

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
}