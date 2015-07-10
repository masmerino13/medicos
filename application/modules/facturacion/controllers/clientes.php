<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends MX_Controller
{
	
	public function __construct()
	{
		parent::__construct();
        $this->load->model('fac_clientes_model','clientes');
	}
	
	//llamamos a la función data_users la cuál nos
	//entrega un array con los usuarios
	public function index()
	{
        $this->template->datatables();
        $this->template->set('seccion','Clientes');
        $this->template->toolbar('add','Nuevo Registro','facturacion/clientes/nuevo','Nuevo Cliente');

        $empId = getEmpresaId();
        $data['clientes'] = $this->clientes->getClientesByEmpresas($empId);
        $this->template->load('template','clientes/index',$data);
			
	}

    public function nuevo()
    {
        $this->load->model('empresas_model','empresa');
        $this->template->set('seccion','Clientes - Nuevo');

        $this->template->formvalidation();
        $script = '$(document).ready(function() {
                $("#adminForm").validationEngine();
            });';
        $this->template->addScript($script);

        $post = $this->input->post();

        if(!empty($post))
        {
            $this->form_validation->set_rules('cli_codigo', 'Codigo', 'trim|required|max_length[20]|xss_clean');
            $this->form_validation->set_rules('cli_nombre_razon_social', 'Nombre o Razon social', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE)
            {
                $error = validation_errors();
                $this->messages->add($error,'error');
                redirect(site_url('facturacion/clientes/nuevo'));
            }else{
                $data = array(
                    'cli_id_src' => $post['cli_id_src'],
                    'cli_id_emp' => getEmpresaId(),
                    'cli_codigo' => $post['cli_codigo'],
                    'cli_nombre_razon_social' => $post['cli_nombre_razon_social'],
                    'cli_tipo_localizacion' => $post['cli_tipo_localizacion'],
                    'cli_tipo_cliente' => $post['cli_tipo_cliente'],
                    'cli_estado' => 0,
                );
                $clienteid = $this->clientes->insertaClientePorEmpresa($data);
                $this->messages->add(SIIE_PROCESS_OK);
                $this->messages->add('Debe ingresar los datos generales.','error');
                $this->messages->add('Debe ingresar los datos fiscales.','error');
                $this->messages->add('Debe ingresar los datos crediticios y cobro.','error');
                redirect(site_url('facturacion/clientes/perfil/'.$clienteid),'refresh');
            }
        }

        $empId = getEmpresaId();
        $data['empresa'] = $this->empresa->getEmpresaById($empId);
        $data['sucursales'] = $this->empresa->getSucursalesByEmpresa($empId);
        $this->template->load('template','clientes/nuevo',$data);
    }

    function perfil($cli_id=0)
    {
        $this->load->model('misc_model','misc');

        $this->template->set('seccion','Clientes - Perfil');
        $this->template->js('js/clientes.js');
        $this->template->formvalidation();
        $script = '$(document).ready(function() {
                $("#adminForm").validationEngine();
                $("#adminFormFicales").validationEngine();
            });';
        $this->template->addScript($script);

        /*$this->messages->add('Debe ingresar los datos generales.','error');
        $this->messages->add('Debe ingresar los datos fiscales.','error');
        $this->messages->add('Debe ingresar los datos crediticios y cobro.','error');*/

        $emp_id = getEmpresaId();

        $data['cliente'] = $this->clientes->getClienteByEmpresa($emp_id,$cli_id);
        $data['departamentos'] = $this->misc->getDepartamentos();

        $this->template->load('template','clientes/perfil',$data);
    }

    function nacional_natural()
    {
        $post = $this->input->post('telefono');

        $tipo = $post['tipo'];
        switch($tipo)
        {
            case 1:
                $this->nacional_natural_generales($post);
                break;
            case 2:
                $this->nacional_natural_fiscales($post);
                break;
        }
    }

    function nacional_natural_generales($post)
    {
        $datos = array(
            'dgn_id_cli' => $post['dgn_id_cli'],
            'dgn_dui' => $post['dgn_dui'],
            'dgn_nombre_comercial' => $post['dgn_nombre_comercial'],
            'dgn_direccion' => $post['dgn_direccion'],
            'dgn_municipio' => $post['dgn_municipio'],
            'dgn_comentario' => $post['dgn_comentario'],
        );

        $cnn_id = $this->clientes->insertaNacionalNatural($datos);
        if($cnn_id > 0)
        {
            $correos = $post['correo'];
            foreach($correos as $k => $row)
            {
                $dataMail = array(
                    'dwe_direccion' => $correos[$k],
                    'dwe_tipo' => 1,
                );

                $this->clientes->insertaWebNacionalNatural($dataMail,$cnn_id);
            }

            $webs = $post['web'];
            $telefono = $post['telefono'];
            $areas = $post['area'];
            $farea = $post['farea'];
            $fax = $post['fax'];
        }
    }

    function nacional_natural_fiscales($post)
    {
        print_r($post);
    }
}
