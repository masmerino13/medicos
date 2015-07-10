<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MX_Controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		
	}
	
	//llamamos a la función data_users la cuál nos
	//entrega un array con los usuarios
	public function index()
	{
        $this->template->set('seccion','Medicos - Panel de control');

        $this->template->load('template','/panel');
			
	}
	
	//llamamos a una función que tiene un parámetro
	public function hola()
	{
		
		$data['saludo'] = Modules::run('login/index/saludo','saludo');
		$this->load->view('saludo',$data);
		
	}
	
}
