<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 07-10-14
 * Time: 12:52 PM
 */
class Inv_Articulos_Model extends CI_Model
{
    var $tabla = 's_inv_art_articulos';

    function getArticulosEmpresa($emp_id){

        $sql = "CALL s_sp_inv_articulos_por_empresa(?)";
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

    function getDetalleArticulo($art_id){
        $sql = "CALL s_sp_inv_detalle_articulo(?)";
        $param = array($art_id);
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

    function inserta_articulos($post)
    {
        $emp_id = getEmpresaId();
        $sql = "CALL s_sp_inv_inserta_articulo_empresa(?,?,?,?,?,?,?,?,?,?,?)";
        $param = array($emp_id, $post['art_descripcion'], $post['art_precio_venta'], $post['art_codigo_inventario'],$post['art_cuenta_compra'],$post['art_cuenta_venta'],$post['art_cuenta_traslado'],$post['grp_parent'],$post['grp_sub_grupo'],$post['art_iva_incluido'],$post['art_estado']);

        $query = $this->db->query($sql,$param);
        $result =  $query->result();

        $query->next_result(); // Dump the extra resultset.
        $query->free_result();

        return $result;
    }

    function actualiza_articulo($post)
    {
        $emp_id = getEmpresaId();
        $sql = "CALL s_sp_inv_actualiza_articulo_empresa(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $param = array($post['art_id'],0,$emp_id, $post['art_descripcion'], $post['art_precio_venta'], $post['art_codigo_inventario'],$post['art_cuenta_compra'],$post['art_cuenta_venta'],$post['art_cuenta_traslado'],$post['grp_parent'],$post['grp_sub_grupo'],$post['art_iva_incluido'],$post['art_estado']);

        $query = $this->db->query($sql,$param);
        $result =  $query->result();

        $query->next_result(); // Dump the extra resultset.
        $query->free_result();

        return $result;
    }
}