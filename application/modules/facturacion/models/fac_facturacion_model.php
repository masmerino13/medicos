<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 5/18/14
 * Time: 3:26 PM
 */

class Fac_Facturacion_Model extends CI_Model
{
    var $tabla_efa = 's_fac_efa_encabezado_factura';
    var $tabla_dfa ='s_fac_dfa_detalle_factura';
    var $tabla_ecf = 's_fac_ecf_encabezado_credito_fiscal';

    function getIconosPanelFacturar($usr_id,$mod_id,$parent)
    {
        $sql = "CALL s_sp_accesos_usuario_por_modulo(?,?,?,?)";
        $param = array($usr_id,$mod_id,$parent,1);
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

    function getFacturasEmpresa($emp_id)
    {
        $sql = "CALL s_sp_fac_ver_facturas_por_empresa(?)";
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

    function getFacturasClienteEmpresa($emp_id,$cli_id)
    {
        $sql = "CALL s_sp_fac_ver_facturas_cliente(?,?)";
        $param = array($emp_id,$cli_id);
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

    function getPuntosPorSucursal($src_id)
    {
        $sql = "CALL s_sp_fac_pve_por_src(?)";
        $param = array($src_id);
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

    function getPuntoVenta($pve_id)
    {
        $emp_id = getEmpresaId();
        $sql = "CALL s_sp_fac_obtener_punto_venta(?,?)";
        $param = array($pve_id, $emp_id);
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

    function validaCodigoFacturaPorEmpresa($codigo_factura)
    {
        $emp_id = getEmpresaId();
        $anio = getAnioPeriodoFical();
        $sql = "CALL s_sp_fac_valida_codigo_factura(?,?,?)";
        $param = array($codigo_factura, $emp_id, $anio);
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

    function getEncabezadoFactura($efa_id)
    {
        $emp_id = getEmpresaId();
        $sql = "CALL s_sp_fac_ver_encabezado_factura(?,?)";
        $param = array($efa_id,$emp_id);
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

    function getDetalleFactura($efa_id)
    {
        $sql = "CALL s_sp_fac_ver_detalle_factura(?)";
        $param = array($efa_id);
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

    function calcularIva($art_id)
    {
        $emp_id = getEmpresaId();
        $sql = "CALL s_sp_fac_calcula_iva(?,?)";
        $param = array($art_id,$emp_id);
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

    function correlativoFactura($anio, $emp_id, $mod_id){

        $sql = "SELECT s_fnc_fac_correlativo_factura(?,?,?) AS n";
        $param = array($anio,$emp_id,$mod_id);
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

    function correlativoCreditoFiscal($anio, $emp_id, $mod_id){
        $sql = "SELECT s_fnc_fac_correlativo_credito_fiscal(?,?,?) AS n";
        $param = array($anio,$emp_id,$mod_id);
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

    function correlativoNotaCredito($anio, $emp_id, $mod_id){
        $sql = "SELECT s_fnc_fac_correlativo_nota_credito(?,?,?) AS n";
        $param = array($anio,$emp_id,$mod_id);
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

    function validaCodigoNotaCreditoPorEmpresa($correlativo)
    {
        $emp_id = getEmpresaId();
        $anio = getAnioPeriodoFical();
        $sql = "CALL s_sp_fac_valida_codigo_factura(?,?,?)";
        $param = array($correlativo, $emp_id, $anio);
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

    function insertaEncabezadoCreditoFiscal($data)
    {
        $this->db->insert($this->tabla_ecf, $data);
        $id = $this->db->insert_id();
        return $id;
    }

    function insertaDetalleFactura($data)
    {
        $usr_id = getUsuarioId();
        $sql = "CALL s_sp_fac_inserta_detalle_factura(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $param = array($data['dfa_id_art'],$data['bod_id'],$data['efa_id_pef'],$usr_id,$data['efa_codigo_factura'],$data['dfa_id_efa'],$data['efa_fecha_factura'],$data['efa_fecha'],1,0,$data['dfa_cantidad'],$data['dfa_precio'],$data['dfa_monto'],);

        $query = $this->db->query($sql,$param);

        $query->next_result(); // Dump the extra resultset.
        $query->free_result();
    }

    function insertaDetalleCreditoFiscal($data)
    {
        $usr_id = getUsuarioId();
        $sql = "CALL s_sp_fac_inserta_detalle_credito_fiscal(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $param = array($data['dfa_id_art'],$data['bod_id'],$data['efa_id_pef'],$usr_id,$data['efa_codigo_factura'],$data['dcf_id_efa'],$data['efa_fecha_factura'],$data['efa_fecha'],1,0,$data['dfa_cantidad'],$data['dfa_precio'],$data['dfa_monto'],);

        $query = $this->db->query($sql,$param);

        $query->next_result(); // Dump the extra resultset.
        $query->free_result();
    }

    function getCreditosFiscalesEmpresa($emp_id)
    {
        $sql = "CALL s_sp_fac_credito_fiscal_por_empresa(?)";
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

    function getCreditosFiscalesPorCliente($emp_id,$cli_id)
    {
        $sql = "CALL s_sp_fac_creditos_fiscales_por_cliente(?,?)";
        $param = array($emp_id,$cli_id);
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

    function getEncabezadoCreditoFiscal($ecf_id)
    {
        $emp_id = getEmpresaId();
        $sql = "CALL s_sp_fac_ver_encabezado_credito_fiscal(?,?)";
        $param = array($ecf_id,$emp_id);
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

    function getDetalleCreditoFiscal($ecf_id)
    {
        $sql = "CALL s_sp_fac_ver_detalle_credito_fiscal(?)";
        $param = array($ecf_id);
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
    //FINALIZA CREDITO FISCAL

    /*INICIA NOTA CREDITO*/
    function insertaNotaCredito($data)
    {
        $sql = "CALL s_sp_fac_inserta_nota_credito(?,?,?,?,?,?,?,?,?,?,?,?,?)";

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

    function getNotasCreditoEmpresa()
    {
        $emp_id = getEmpresaId();
        $sql = "CALL s_sp_fac_ver_notas_credito(?)";
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
    /*FIN NOTA CREDITO*/

    /*INICIA DEVOLUCION*/
    function getDevolucionesEmpresa()
    {
        $emp_id = getEmpresaId();
        $sql = "CALL s_sp_ver_facturas_devolucion(?)";
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

    function insertaFacturaDevolucion($data)
    {
        $sql = "CALL s_sp_fac_inserta_devolucion_factura(?,?,?,?,?,?,?)";

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
    /*FIN DEVOLUCION*/
}