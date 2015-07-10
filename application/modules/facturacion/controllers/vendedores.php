<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vendedores extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('fac_vendedores_model','vendedores');
        $this->load->model('empresas_model','empresas');
    }

    function index()
    {
        $this->template->set('seccion','Vendedores empresa');
        $this->template->datatables();

        $this->template->toolbar('add','Nuevo vendedor','facturacion/vendedores/nuevo','Nuevo vendedor');

        $emp_id = getEmpresaId();
        $data['vendedores'] = $this->vendedores->getVendedoresPorEmpresa($emp_id);

        $this->template->load('template','/vendedores/index',$data);
    }

    function nuevo()
    {
        $this->template->set('seccion','Nuevo vendedor');
        $this->template->formvalidation();
        $this->template->js('js/facturacion/vendedores.js');
        $script = "$('#adminForm').validationEngine();";
        $this->template->addScript($script);

        $emp_id = getEmpresaId();
        $data['empresa'] = $this->empresas->getEmpresaById($emp_id);
        $data['personal'] = $this->empresas->getEmpleadosByEmpresa($emp_id);

        $post = $this->input->post();
        if(!empty($post))
        {
            $result = $this->vendedores->insertaVendedorEmpresa($post);

            if(!empty($result))
            {
                @$error = $result[0]->fail;
                @$msg = $result[0]->msg;
                if($error == '1')
                {
                    $redirect = 'facturacion/vendedores/nuevo';
                    $msj = '<b>Error!</b> El empleado seleccionado no existe.';
                    $type = 'error';
                }elseif($error == '02')
                {
                    $redirect = 'facturacion/vendedores/nuevo';
                    $msj = '<b>Aviso!</b> El empleado ya ha sido definido como vendedor.';
                    $type = 'alert';
                }elseif($msg > 0)
                {
                    $redirect = 'facturacion/vendedores/perfil/'.$msg;
                    $msj = SIIE_PROCESS_OK;
                    $type = '';

                    $this->messages->add('Debe completar el perfil del vendedor.','alert');
                }
            }

            $this->messages->add($msj,$type);
            redirect(site_url($redirect),'refresh');
        }

        $this->template->load('template','/vendedores/nuevo',$data);
    }

    function perfil($vxe_id)
    {
        $this->template->set('seccion','Perfil vendedor');
        $this->template->js('js/facturacion/vendedores.js');

        $vendedor = $this->vendedores->getVendedorById($vxe_id);
        if(empty($vendedor)):
            $this->messages->add('El vendedor no existe.','alert');
            redirect(site_url('facturacion/vendedores'));
            endif;

        $post = $this->input->post();
        if(!empty($post))
        {
            $tipo = $post['tipo'];
            if($tipo == 1):
            elseif($tipo == 2):
                //INSERTAMOS SUCURSAL Y PUNTO DE VENTA
                $this->vendedores->insertaSucursalVendedor($post);
            $this->messages->add('Se ha actualizado el perfil del vendedor.');
            redirect(site_url('facturacion/vendedores/perfil/'.$vxe_id),'refresh');
            endif;
        }

        $emp_id = getEmpresaId();
        $data['vendedor'] = $vendedor;
        $data['vxe_id'] = $vxe_id;
        $data['sucursales'] = $this->empresas->getSucursalesByEmpresa($emp_id);

        $this->template->load('template','/vendedores/perfil',$data);
    }
}