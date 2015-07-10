<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Factura extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('facturacion_model');
	}

	
	function index()
	{
		$output['articulos'] = $this->facturacion_model->get_tabla('s_art_articulo',array('art_estado'=>1));
		$output['clientes'] = $this->facturacion_model->get_tabla('s_cli_cliente');	
		$output['cajas'] = $this->facturacion_model->get_tabla('f_caj_caja',array('caj_estado'=>1));	 

		$this->template->set('seccion','Facturacion');
		$this->template->load('template','factura',$output);
		
	}
		
	function verificar_cuenta()
	{
		$cuenta = $this->facturacion_model->get_tabla('f_cue_cuenta',array('cue_id_cli'=>$_POST['id_cliente']));		
		if(count($cuenta)==0) {
			echo json_encode(array('posee' => 0));
		}			
		else {
			$cuenta[0]['posee'] = 1;
			echo json_encode($cuenta[0]);
		}
	}

	function get_articulo()
	{
		$articulo = $this->facturacion_model->get_tabla('s_art_articulo',array('art_id'=>$_POST['id_articulo']));
		echo json_encode($articulo[0]);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */