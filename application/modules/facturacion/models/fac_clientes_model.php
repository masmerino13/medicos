<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 5/3/14
 * Time: 12:07 PM
 */
class fac_clientes_model extends CI_Model
{
    var $tabla = 's_gen_cli_clientes';
    var $tabla_nn = 's_gen_dgn_natural_nacional';
    var $tabla_web = 's_gen_dwe_directorio_web';
    var $tabla_web_nn = 's_gen_wnn_web_nacional_natural';
    var $id = 'cli_id';

    function getClientesByEmpresas($empresa)
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla);
        $this->db->join('s_emp_empresas', 'emp_id = cli_id_emp' );
        $this -> db -> where('cli_id_emp', $empresa);

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
}