<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cotizacion extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('facturacion_model');
	}

	function index()
	{
		$articulos = $this->facturacion_model->get_tabla('s_art_articulo',array('art_estado'=>1));
		$output['articulos'] = $articulos;

		$this->template->set('seccion','Cotizacion');
		$this->template->load('template','cotizacion',$output);
		
	}

	function get_articulo()
	{
		$articulo = $this->facturacion_model->get_tabla('s_art_articulo',array('art_id'=>$_POST['id_articulo']));
		echo json_encode($articulo[0]);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */