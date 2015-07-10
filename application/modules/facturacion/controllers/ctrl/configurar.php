<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configurar extends MX_Controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		
	}
	
	//llamamos a la función data_users la cuál nos
	//entrega un array con los usuarios
	public function index()
	{
        $this->template->set('seccion','Facturación - Administración del Modulo');

        $this->template->load('template','configuracion/panel');
			
	}
	
	//llamamos a una función que tiene un parámetro
	public function hola()
	{

        $this->messages->add('Esto esto');
        $this->messages->add('Esto esto','error');
        $this->messages->add('Esto esto','alert');
		$data['saludo'] = Modules::run('login/index/saludo','saludo');
		$this->load->view('saludo',$data);
		
	}
	
}
