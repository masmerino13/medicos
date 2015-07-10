<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 5/1/14
 * Time: 10:42 PM
 */
class periodos_model extends CI_Model
{
    var $tabla = 's_gen_pef_periodo_fiscal';
    var $id = 'pef_id';

    function getPeriodosFiscales()
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla);

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

    function getPeriodoById($per_id)
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla);
        $this->db->where($this->id,$per_id);

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

    function getPeriodoActivo()
    {
        $this -> db -> select('*');
        $this -> db -> from($this->tabla);
        $this->db->where('pef_mes',date('m'));
        $this->db->where('pef_anio',date('Y'));
        $this->db->limit(1);

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

    function insertaPeriodoFiscal($post)
    {
        $data = array(
            'pef_mes' => $post['pef_mes'],
            'pef_anio' => $post['pef_anio'],
        );
        $this->db->insert($this->tabla,$data);
    }

    function setPeriodoFavorito($per_id)
    {
        $this->setTodosInactivos();
        $data = array(
            'pef_estado' => 1
        );

        $this->db->where($this->id, $per_id);
        $this->db->update($this->tabla, $data);

        return true;
    }

    function setTodosInactivos()
    {
        $data = array(
            'pef_estado' => 0
        );
        $this->db->update($this->tabla, $data);
    }
}