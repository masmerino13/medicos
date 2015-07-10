<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 6/26/14
 * Time: 9:19 PM
 */
class Fac_Configuracion_Model extends CI_Model{

    function getConfigElementos($mod_id="")
    {
        if(empty($mod_id))
        {
            $mod_id = getModuloId();
        }

        $sql = "CALL s_sp_gen_elementos_config_modulo(?)";
        $param = array($mod_id);
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

    function getConfigEmpresa($emp_id="", $mod_id="")
    {
        if(empty($emp_id))
        {
            $emp_id = getEmpresaId();
        }

        if(empty($mod_id))
        {
            $mod_id = getModuloId();
        }

        $sql = "CALL s_sp_gen_config_x_modulo_empresa(?,?)";
        $param = array($emp_id,$mod_id);
        $query = $this->db->query($sql,$param);

        if(($query) && ($query->num_rows() > 0))
        {
            $result = $query->result();
        }
        else
            $result = false;

        $query->next_result(); // Dump the extra resultset.
        $query->free_result();

        if(!empty($result))
        {
            foreach($result as $key => $row):
                $data[$row->cxm_cons] = $row->cxe_valor;
            endforeach;
        }else{
            $data = '';
        }

        return $data;
    }

    function verificaConfigModulo($mod_id,$emp_id,$cxm_id, $valor)
    {
        $sql = "CALL s_sp_gen_verifica_config_modulo(?,?,?,?)";
        $param = array($mod_id,$emp_id,$cxm_id,$valor);
        $query = $this->db->query($sql,$param);

        $query->next_result(); // Dump the extra resultset.
        $query->free_result();
    }
}