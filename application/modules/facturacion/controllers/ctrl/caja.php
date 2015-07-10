<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Caja extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('facturacion_model');
	}

function index()
	{
		$this->template->set('seccion','Gestion de cajas');

        $columns = array(
            'caj_nombre'
            ,'caj_descripcion'
            ,'caj_estado'            
            );
        $edit = array(
            'caj_nombre'
            ,'caj_descripcion'
            
            );
        $add = array(
            'caj_nombre'
            ,'caj_descripcion'
            
            );
        $alias = array(
            'caj_nombre' => 'Nombre'
            ,'caj_descripcion' => 'Descripcion'
            ,'caj_estado' => 'Estado'
            );
        $required = array(
            'caj_nombre'            
            );

        $this->grocery_crud->set_table('f_caj_caja')
            ->order_by('caj_id')
            ->set_subject('Cajas')
            ->columns($columns)
            ->edit_fields($edit)
            ->add_fields($add)
            ->display_as($alias)
            ->required_fields($required);

        //$this->grocery_crud->set_relation('caj_id_suc','s_suc_sucursal','suc_nombre');

        $output = $this->grocery_crud->render();

        $this->_grocery_output($output);
    }

    function gestion($estado = "")
    {    	
    	if ($estado != "") {
    		$est = -1;
            $estado = strtolower($estado);
            if($estado=="apertura") {
                $est = 0;
                $est2 = 1;
            }
                
            else if ($estado =="cierre") {
                $est = 1;
                $est2 = 0;
            }
                
            if ($_POST) {
                if($estado=="apertura") {                
                    $ingreso = $_POST['txt_cantidad'];
                    $salida = 0.0;
                }
                    
                else if ($estado =="cierre") {                
                    $salida = $_POST['txt_cantidad'];
                    $ingreso = 0.0;
                }

                $movimiento_caja = array(
                    'mcj_id_caj' => $_POST['cmb_caja']
                    ,'mcj_fecha' => date('Y-m-d')
                    ,'mcj_ingreso' => $ingreso
                    ,'mcj_salida' => $salida
                    ,'mcj_id_usu' => 1
                    );

                $this->facturacion_model->insertar('f_mcj_movimiento_caja',$movimiento_caja);
                $this->facturacion_model->actualizar('f_caj_caja', array('caj_estado' => $est2), array('caj_id' => $_POST['cmb_caja']));
                redirect('facturacion/caja/gestion/'.$estado);
            }
    		
    		

	    	if ($est >=0) {
	    		$cajas = $this->facturacion_model->get_tabla('f_caj_caja',array('caj_estado'=>$est));
		    	$output['cajas'] = $cajas;	
                $output['estado'] = $estado;

				$this->template->set('seccion','Apertura y cierre');
				$this->template->load('template','gestion_caja',$output);		
	    	}	    	
    	}    	
    }    

    function movimiento()
    {}    

    function _grocery_output($output = null)
    {
        $this->template->load('template','grocery_view',$output);
    }	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */