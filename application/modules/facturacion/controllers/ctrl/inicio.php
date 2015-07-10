<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->template->set('seccion','Gestor de Empresas');
		$output['data'] = "otro hola";
		$this->template->load('template','welcome');
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */