<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/24/14
 * Time: 9:11 PM
 */
class Empresas_model extends CI_Model
{
    var $tabla = 's_emp_empresas';
    var $tabla_per = 's_per_personas';
    var $tabla_pxe = 's_pxe_personasxempresa';
    var $tabla_sucursales = 's_gen_src_sucursales';
    var $tabla_pve = "s_fac_pve_puntos_venta";
    var $tabla_upv = 's_fac_upv_usuarios_x_pve';
    var $id = 'emp_id';

    function getEmpresaById($emp_id)
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla);
        $this -> db -> where($this->id, $emp_id);
        $this -> db -> limit(1);

        $query = $this -> db -> get();

        if($query -> num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    function getUltimoCorrelativoSucursal($emp_id)
    {
        $this->db->select_max('scr_correlativo');
        $this->db->where('src_id_emp', $emp_id);
        $query = $this->db->get($this->tabla_sucursales);

        $data = $query->result();
        $correlativo = ($data[0]->scr_correlativo) + 1;

        switch(strlen($correlativo)){
            case 1:
                $numero = '000000000'.$correlativo;
                break;
            case 2:
                $numero = '00000000'.$correlativo;
                break;
            case 3:
                $numero = '0000000'.$correlativo;
                break;
            case 4:
                $numero = '000000'.$correlativo;
                break;
            case 5:
                $numero = '00000'.$correlativo;
                break;
            case 6:
                $numero = '0000'.$correlativo;
                break;
            case 7:
                $numero = '000'.$correlativo;
                break;
            case 8:
                $numero = '00'.$correlativo;
                break;
            case 9:
                $numero = '0'.$correlativo;
                break;
            case 10:
                $numero = $correlativo;
                break;
        }
    return $numero;
    }

    function inseta_personal($data)
    {
        $this->db->insert($this->tabla_per, $data);
        return $this->db->insert_id();
    }

function insertaPrueba($data)
    {
        $this->db->insert('prueba', $data);
        return true;
    }

    function listaPruebas()
    {
        $this -> db -> select('*, year(fecha_nac) as anio');
        $this -> db -> from('prueba');

        $query = $this -> db -> get();

        return $query->result();
    }

    function pvePorSucursalEmpresa($data)
    {
        $this->db->insert($this->tabla_pve, $data);
        return $this->db->insert_id();
    }

    function usuarioPorPuntoVenta($usr_id,$pve_id)
    {
        $array = array(
            'upv_id_usr' => $usr_id,
            'upv_id_pve' => $pve_id,
        );
        $this->db->insert($this->tabla_upv, $array);
    }

    function insertaDatosGenralesSrc($post)
    {
        $datos = array(
            'dgs_telefono' => $post['dgs_telefono'],
            'dgs_id_src' => $post['src_id'],
        );
        $this->db->insert('s_gen_datos_src', $datos);

    }

    function sucursalPorEmpresa($data)
    {
        $this->db->insert($this->tabla_sucursales, $data);
        return true;
    }

    function inserta_personaxempresa($data)
    {
        $this->db->insert($this->tabla_pxe,$data);
        return true;
    }

    function getEmpleadosByEmpresa($emp_id)
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla_per);
        $this->db->join('s_pxe_personasxempresa', 'pxe_id_per = per_id' );
        $this -> db -> where('pxe_id_emp', $emp_id);

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

    function getSucursalPorId($src_id)
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla_sucursales);
        $this -> db -> where('src_id', $src_id);

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

    function puntosPorSucursal($src_id)
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla_pve);
        $this -> db -> where('pve_id_src', $src_id);

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

    function getSucursalesByEmpresa($emp_id)
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla_sucursales);
        $this -> db -> where('src_id_emp', $emp_id);

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


    function listaEmpleadosByEmpresa($emp_id)
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla_per);
        $this->db->join('s_pxe_personasxempresa', 'pxe_id_per = per_id' );
        $this -> db -> where('pxe_id_emp', $emp_id);

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

    function getUsuariosPorEmpresaSesion($emp_id)
    {
        if(empty($emp_id))
        {
            $emp_id = getEmpresaId();
        }

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

    function getEmpresasUsuarioLogin($usr_id="")
    {
        if(empty($usr_id))
        {
            $usr_id = getUsuarioId();
        }

        $sql = "CALL s_sp_empresas_por_usuario(?)";
        $param = array($usr_id);
        $query = $this->db->query($sql,$param);

        if(($query) && ($query->num_rows() > 0))
        {
            $result = $query->result();
        }
        else
            $result = false;

        $query->next_result(); // Dump the extra resultset.
        $query->free_result();

        //$query->close();

        return $result;
    }

    function setEmpresaPredeterminada($emp_id)
    {

    }
}