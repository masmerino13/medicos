<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grupos extends MX_Controller{

	function __construct(){
        parent::__construct();
    	$this->load->model('inv_grupos_model','grupos');
	} 
    function index(){
        $this->template->set('seccion','Listado grupos');
        $this->template->datatables();
        $this->template->toolbar('add','Nuevo grupo','bodegas/grupos/nuevo','Nuevo grupo');

         $var["grupos"]=$this->grupos->getGruposParent();
        $this->template->load('template','/grupos/index',$var);
         }

	function nuevo(){
            $this->template->set('seccion','Grupos - Nuevo Grupo');

            $var["grupos"]=$this->grupos->getGruposParent();

             $post = $this->input->post();

            if(!empty($post)){
                $datos = array(
                    'grp_id_emp' => getEmpresaId(),
                    'grp_descripcion' => $post['grp_descripcion'],
                    'grp_parent' => $post['grp_parent'],
                );

                if ($this->grupos->inserta_grupo($datos)){
                    $this->messages->add(SIIE_PROCESS_OK);
                    redirect(site_url('bodegas/grupos'),'refresh');
                }
            }
        $this->template->load('template','/grupos/nuevo',$var);
	}

    function subgrupos()
    {
        $grp_id = $this->input->post('grp_id');

        $subgrupos = $this->grupos->getSubGrupos($grp_id);

        echo '<select class="nostyle required" id="combobox" name="grp_sub_grupo">';
            echo '<option value="0">Seleccionar sub grupo</option>';
            if(!empty($subgrupos)){
                foreach($subgrupos as $row){
                    echo '<option value="'.$row->grp_id.'">'.$row->grp_descripcion.'</option>';
                }
            }
        echo '</select>';
    }
}

				   