<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 1/16/2015
 * Time: 8:46 PM
 */
class Med_Pacientes_Model extends CI_Model
{
    var $tabla = 's_med_pac_pacientes';
    var $id = 'med_id';

    function insertaPaciente($post)
    {
        $data = array(
            getEmpresaId(),
            ($post['pac_primer_nombre']),
            ($post['pac_segundo_nombre']),
            ($post['pac_primer_apellido']),
            ($post['pac_segundo_apellido']),
            ($post['pac_direccion']),
            isNull($post['pac_telefonos']),
            isNull($post['pac_correos']),
            $post['pac_fecha_nacimiento'],
            ($post['pac_diagnostico']),

        );

        $sql = "CALL s_sp_med_inserta_paciente(?,?,?,?,?,?,?,?,?,?)";

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

    function getPacientesConsultorio($con_id)
    {
        $data = array($con_id);

        $sql = "CALL s_sp_med_ver_pacientes(?)";

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

    function getPacienteConsultorio($con_id,$pac_key)
    {
        $data = array($con_id,$pac_key);

        $sql = "CALL s_sp_med_ver_paciente(?,?)";

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