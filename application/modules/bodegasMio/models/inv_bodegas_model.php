<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 5/3/14
 * Time: 12:07 PM
 */
class inv_bodegas_model extends CI_Model
{
    var $tabla = 's_inv_bod_bodegas';
    var $id = 'bod_id';

    function getBodegaById($bod_id)
    {
        $emp_id = getEmpresaId();
        $this -> db -> select('*');
        $this -> db -> from($this->tabla);
        $this -> db -> where('bod_id', $bod_id);
        $this -> db -> where('bod_id_emp', $emp_id);

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

    function getBodegasByEmpresas($empresa="")
    {
        if(empty($empresa))
        {
            $empresa = getEmpresaId();
        }

        $this -> db -> select('*');
        $this -> db -> from($this->tabla);
        $this -> db -> where('bod_id_emp', $empresa);

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

    function getClienteByEmpresa($empresa,$cliente)
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla);
        $this->db->join('s_emp_empresas', 'emp_id = cli_id_emp' );
        $this->db->join('s_gen_src_sucursales', 'src_id = cli_id_src' );
        $this -> db -> where('cli_id_emp', $empresa);
        $this -> db -> where('cli_id', $cliente);

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

    function getArticulosPorBodega($bod_id)
    {
        $sql = "CALL s_sp_inv_articulos_x_bodega(?)";
        $param = array($bod_id);
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

    function getArticulosPorEmpresa($emp_id)
    {
        $sql = "CALL s_sp_inv_articulos_empresa(?)";
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

    function insertaArticuloPorBodega($post)
    {
        $emp_id = getEmpresaId();
        $sql = "CALL s_sp_inv_insertar_articulos_x_bodega(?,?,?)";
        $param = array($emp_id, $post['bod_id'], $post['art_id']);

        $query = $this->db->query($sql,$param);
        $result =  $query->result();

        $query->next_result(); // Dump the extra resultset.
        $query->free_result();

        return $result;
    }

    function insertaClientePorEmpresa($data)
    {
        $this->db->insert($this->tabla,$data);
        return $this->db->insert_id();
    }

    function insertaNacionalNatural($data)
    {
        $this->db->insert($this->tabla_nn,$data);
        return $this->db->insert_id();
    }

    function insertaWebNacionalNatural($data,$id_nn)
    {
        $this->db->insert($this->tabla_web,$data);
        $insertid = $this->db->insert_id();
        $this->insertaWebPorNN($insertid,$id_nn);
        return true;
    }

    function insertaWebPorNN($insertid,$id_nn)
    {
        $data = array(
            'wnn_id_dwe' => $insertid,
            'wnn_id_dgn' => $id_nn,
        );
        $this->db->insert($this->tabla_web_nn,$data);
    }


}