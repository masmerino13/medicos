<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 6/20/14
 * Time: 8:01 PM
 */

class Fac_Cotizaciones_Model extends CI_Model
{
    var $tabla = 's_fac_ect_encabezado_cotizacion';

    function getCotizacionesEmpresa($emp_id)
    {
        $sql = "CALL s_sp_fac_cotizaciones_por_empresa(?)";
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

    function getSucursalesUsrEmp($emp_id, $usr_id)
    {
        $sql = "CALL s_sp_ge_sucursales_usr_emp(?,?)";
        $param = array($usr_id, $emp_id);
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

    function correlativoCotizacion($anio, $emp_id)
    {
        $sql = "SELECT s_fnc_fac_correlativo_cotizacion(?,?) as n";
        $param = array($anio,$emp_id);
        $query = $this->db->query($sql,$param);

        if(($query) && ($query->num_rows() > 0))
        {
            $result = $query->result();
        }
        else
            $result = false;

        $query->next_result(); // Dump the extra resultset.
        $query->free_result();

        return $result[0]->n;
    }

    function insertaEncabezadoCotizacion($data)
    {
        $this->db->insert($this->tabla, $data);
        $id = $this->db->insert_id();
        return $id;
    }

    function insertaDetalleCotizacion($data)
    {
        $usr_id = getUsuarioId();
        $sql = "CALL s_sp_fac_inserta_detalle_cotizacion(?,?,?,?,?,?)";

        $query = $this->db->query($sql,$data);

        $query->next_result(); // Dump the extra resultset.
        $query->free_result();
    }

    function validaCodigoCotizacionPorEmpresa($correlativo_cotizacion)
    {
        $emp_id = getEmpresaId();
        $sql = "CALL s_sp_fac_valida_correlativo_cotizacion(?,?)";
        $param = array($correlativo_cotizacion, $emp_id);
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

    function getEncabezadoCotizacion($ect_id)
    {
        $emp_id = getEmpresaId();
        $sql = "CALL s_sp_fac_ver_encabezado_cotizacion(?,?)";
        $param = array($ect_id, $emp_id);
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

    function getDetalleCotizacion($ect_id,$tipo)
    {
        $sql = "CALL s_sp_fac_ver_detalle_cotizacion(?,?)";
        $param = array($ect_id,$tipo);
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
}