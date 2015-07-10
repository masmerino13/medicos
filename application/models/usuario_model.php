<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/12/14
 * Time: 8:23 PM
 */
class Usuario_model extends CI_Model
{
    function getUsuario($usuario,$contra)
    {
        $this -> db -> select('usr_id, usr_login');
        $this -> db -> from('s_usr_usuarios');
        $this -> db -> where('usr_login', $usuario);
        $this -> db -> where('usr_contra', sha1($contra));
        $this -> db -> where('usr_estado', '1');
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

    function getCredencialesInicio($usuario_id)
    {
        $sql = "CALL s_sp_datos_usuario_login(?)";
        $param = array($usuario_id);
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

    function getModulosPorUsuario($usuario_id)
    {
        $sql = "CALL s_sp_modulos_por_usuario(?)";
        $param = array($usuario_id);
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

    function getAccesosUsuarioPorModulo($usr_id,$mod_id,$parent,$prefix,$sub,$hash,$nivel)
    {
        $sql = "CALL s_sp_accesos_usuario_por_modulo(?,?,?,?)";
        $param = array($usr_id,$mod_id,$parent,0);
        $query = $this->db->query($sql,$param);

        if($parent == 0)
            $prefix = '';
        else
            $prefix = ' ';


        if(($query) && ($query->num_rows() > 0))
        {
            echo '<ul class="'.$sub.'" >';
            $datos = $query->result();
            foreach($datos as $key => $row){
                echo '<li><a class="'.$hash.'" href="'.site_url('core/itemId/'.$datos[$key]->ixm_id).'"><span class="icon16 icomoon-icon-arrow-right"></span>'.$prefix.$datos[$key]->ixm_titulo.'</a>';
                $query->next_result(); // Dump the extra resultset.
                $query->free_result();
                $this->getAccesosUsuarioPorModulo($usr_id,$mod_id,$datos[$key]->ixm_id,$prefix.$prefix,$sub='sub',$hash='',$nivel=2);
                echo '</li>';
                $query->next_result(); // Dump the extra resultset.
                $query->free_result();
            }
            echo '</ul>';
        }



        $query->next_result(); // Dump the extra resultset.
        $query->free_result();


    }

    function getAtributosUsuario($rol_id,$menu_id)
    {
        $sql = "CALL s_sp_atributos_usuario(?,?)";
        $param = array($rol_id,$menu_id);
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
}
?>