<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 7/11/14
 * Time: 8:12 PM
 */
class Fac_Vendedores_Model extends CI_Model
{
    var $tabla = 's_fac_vxe_vendedores_empresa';
    var $id = 'vxe_id';

    function getVendedoresPorEmpresa($emp_id)
    {
        if(empty($emp_id))
            $emp_id = getEmpresaId();
        else
            $emp_id = $emp_id;

        $sql = "CALL s_sp_fac_vendedores_empresa(?)";
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

    function insertaVendedorEmpresa($array)
    {
        $emp_id = getEmpresaId();
        $sql = "CALL s_sp_fac_inserta_vendedor_empresa(?,?,?,?)";
        $param = array($emp_id, $array['vxe_id_emp'], $array['vxe_codigo_vendedor'],date('Y/m/d h:i:s'));

        $query = $this->db->query($sql,$param);

        $result = $query->result();

        $query->next_result();
        $query->free_result();

        return $result;
    }

    function getVendedorById($vxe_id)
    {
        $emp_id = getEmpresaId();
        $sql = "CALL s_sp_fac_vendedor(?,?)";
        $param = array($vxe_id, $emp_id);

        $query = $this->db->query($sql,$param);

        $result = $query->result();

        $query->next_result();
        $query->free_result();

        return $result;
    }

    function getVendedoresEmpresa($emp_id,$src_id,$pve_id)
    {
        $sql = "CALL s_sp_fac_vendedores_factura(?,?,?)";
        $param = array($emp_id,$src_id,$pve_id);

        $query = $this->db->query($sql,$param);

        $result = $query->result();

        $query->next_result();
        $query->free_result();

        return $result;
    }

    function insertaSucursalVendedor($array)
    {
        $data = array(
            'vxe_id_src' => $array['vxe_id_src'],
            'vxe_id_pve' => $array['efa_id_pve'],
        );

        $this->db->where($this->id, $array['vxe_id']);
        $this->db->update($this->tabla, $data);

        return true;
    }
}