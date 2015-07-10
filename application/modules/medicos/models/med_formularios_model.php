<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 1/17/2015
 * Time: 8:34 PM
 */

class Med_Formularios_Model extends CI_Model
{
    var $tabla_elementos = 's_med_tef_tipo_elemento_form';

    function getFormulariosConsulta($con_id)
    {
        $data = array($con_id);
        $sql = "CALL s_sp_med_ver_formularios_consulta(?)";

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

    function getElelentoFormularioPorTipo($tipo,$form_id)
    {
        $data = array($tipo, $form_id);
        $sql = "CALL s_sp_med_ver_elementos_por_tipo(?,?)";

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

    function getElelentoFormularioPorGrupo($grupo)
    {
        $data = array($grupo);
        $sql = "CALL s_sp_med_ver_elementos_grupo(?)";

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

    function getFormularioEncabezado($con_id)
    {
        $emp_id = getEmpresaId();
        $data = array($emp_id, $con_id);
        $sql = "CALL s_sp_med_ver_formulario_consulta(?,?)";

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

    function insertaForm($data)
    {
        $emp_id = getEmpresaId();
        $data = array($emp_id,$data['fxc_titulo'],$data['fxc_descripcion']);
        $sql = "CALL s_sp_med_inserta_formulario_consulta(?,?,?)";

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

    function insertaElementoForm($data)
    {
        $data = array($data['fxc_id'],$data['exf_label'],$data['exf_tipo'],$data['exf_socio'],$data['exf_grupo']);
        $sql = "CALL s_sp_med_insertar_elemento_form(?,?,?,?,?)";

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

    function insertaEncabezadoConsulta($data)
    {
        $sql = "CALL s_sp_med_inserta_encabezado_eco(?,?,?)";

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

    function insertaFormularioPaciente($data)
    {
        $sql = "CALL s_sp_med_inserta_detalle_consulta(?,?,?,?)";

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

    function getTiposElementos()
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla_elementos);

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