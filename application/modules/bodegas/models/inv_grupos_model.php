<?php 

	class Inv_grupos_model extends CI_Model{
		    var $tabla = 's_inv_grp_grupos';

	function inserta_grupo($datos){

		 $this->db->insert($this->tabla,$datos);
        return true;
	}

	function getGruposParent(){
        $emp_id = getEmpresaId();
		$this -> db -> select('*');
        $this -> db -> from($this->tabla);
        $this -> db -> where("grp_parent", 0);
        $this -> db -> where("grp_id_emp", $emp_id);
      
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

    function getSubGrupos($grp_id){
        $emp_id = getEmpresaId();
        $this -> db -> select('*');
        $this -> db -> from($this->tabla);
        $this -> db -> where("grp_parent", $grp_id);
        $this -> db -> where("grp_id_emp", $emp_id);

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
