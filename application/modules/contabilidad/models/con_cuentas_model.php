<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 5/18/14
 * Time: 3:26 PM
 */

class Con_Cuentas_Model extends CI_Model
{
    var $tabla_ccc = 's_gen_ccc_catalogo_contable';

    function getCuentasContables()
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla_ccc);
        $this->db->order_by('ccc_cuenta','DESC');

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

    function getCuentasParents($parent)
    {
        $emp_id = getEmpresaId();
        $sql = "CALL s_sp_con_catalogo_contable(?,?)";
        $param = array($parent,$emp_id);
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

    function getDetalleCuenta($cuenta)
    {
        $emp_id = getEmpresaId();
        $sql = "CALL s_sp_con_ver_detalle_cuenta_contable(?,?)";
        $param = array($cuenta,$emp_id);
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

    function getCuentasParentsTree($parent,$prefix,$sub,$hash,$nivel)
    {

        $sql = "CALL s_sp_con_catalogo_contable(?)";
        $param = array($parent);
        $query = $this->db->query($sql,$param);

        if($parent == 0)
            $prefix = '';
        else
            $prefix = ' ';

        $li ='';
        if(($query) && ($query->num_rows() > 0))
        {
            echo '<ul class="'.$sub.'" >';
            $datos = $query->result();

            foreach($datos as $key => $row){
                echo  '<li><a class="'.$hash.'" href="#"><span class="icon16 icomoon-icon-arrow-right"></span>'.$prefix.$datos[$key]->ccc_cuenta.':'.$datos[$key]->ccc_descripcion.'</a>';
                $query->next_result(); // Dump the extra resultset.
                $query->free_result();
                $this->getCuentasParentsTree($datos[$key]->ccc_cuenta,$prefix.$prefix,$sub='sub',$hash='',$nivel=2);
                echo '</li>';
                $query->next_result(); // Dump the extra resultset.
                $query->free_result();
            }
            echo '</ul>';
        }

        return $li;

        $query->next_result(); // Dump the extra resultset.
        $query->free_result();


    }

    function insertaCuenta($data)
    {
        $this->db->insert($this->tabla_ccc,$data);
        return true;
    }

    function actualizaCuenta($post)
    {
        $data = array(
            'ccc_cuenta' => $post['ccc_cuenta'],
            'ccc_descripcion' => $post['ccc_descripcion'],
            'ccc_tipo_cuenta' => $post['ccc_tipo_cuenta'],
            'ccc_parent' => $post['ccc_parent'],
            'ccc_detalle' => $post['ccc_detalle'],
        );

        $this->db->where('ccc_id', $post['ccc_id']);
        $this->db->update($this->tabla_ccc, $data);
    }

    function tiposCuentas()
    {
        $array = array();
        $array[] = ['id' => 1, 'label'=>'CUENTA DE ACTIVO'];
        $array[] = ['id' => 2, 'label'=>'CUENTAS DE PASIVO'];
        $array[] = ['id' => 3, 'label'=>'CUENTAS DE PATRIMONIO'];
        $array[] = ['id' => 4, 'label'=>'CUENTAS DE COSTOS'];
        $array[] = ['id' => 5, 'label'=>'CUENTAS DE GASTOS'];
        $array[] = ['id' => 6, 'label'=>'CUENTAS DE PRODUCTOS'];
        $array[] = ['id' => 7, 'label'=>'CUENTAS DE CIERRE O LIQUIDADORAS'];

        return $array;
    }
}