<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/23/14
 * Time: 9:33 PM
 */
class Empresas extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('empresas_model','empresas');
    }

    function ini()
    {
        $this->template->set('seccion','Gestor de Empresas');
        $this->template->css('plugins/tables/dataTables/jquery.dataTables.css');
        $this->template->js('plugins/tables/dataTables/jquery.dataTables.min.js');
        $this->template->js('plugins/tables/responsive-tables/responsive-tables.js');
        $this->template->js('js/datatable.js');

        $this->grocery_crud->set_table('s_emp_empresas')
                           ->order_by('emp_razon_social')
                           ->set_subject('Empresa')
                           ->columns('emp_razon_social','emp_correlativo')
                           ->display_as('emp_razon_social','Razon Social')
                           ->required_fields('emp_razon_social')
                           ->add_action('Personal', 'icon-user', 'empresas/personal','')
                           ->add_action('Sucursales', 'icomoon-icon-home-6', 'empresas/sucursales','');

        $output = $this->grocery_crud->render();

        $this->_grocery_output($output);
    }

    function personal($emp_id=0)
    {
        $this->template->set('seccion','Gestor de Empresas - Personal');
        $this->template->js('plugins/forms/validate/jquery.validate.min.js');
        $this->template->js('plugins/forms/maskedinput/jquery.maskedinput-1.3.min.js');
        $this->template->js('js/forms.js');
        $this->template->js('js/form-validation.js');

        $data['empresa'] = $this->empresas->getEmpresaById($emp_id);
        $data['personal'] = $this->empresas->getEmpleadosByEmpresa($emp_id);
        $data['emp_id'] = $emp_id;

        $this->template->load('template','empresas/personal',$data);
    }

    function sucursales($emp_id=0)
    {
        $this->load->helper('facturacion');
        $this->template->set('seccion','Gestor de Empresas - Sucursales');

        $this->template->formvalidation();
        $js = " $(document).ready(function(){
        $('#form-validate').validationEngine();
        });";
        $this->template->addScript($js);

        if(empty($emp_id))
        {
            $emp_id = getEmpresaId();
        }

        $post = $this->input->post();
        if(!empty($post))
        {
            $array = array(
                'src_id_emp' => $post['src_id_emp'],
                'src_descripcion' => $post['src_descripcion'],
                'src_direccion' => $post['src_direccion'],
                'scr_correlativo' => $post['scr_correlativo'],
            );

            if($this->empresas->sucursalPorEmpresa($array))
            {
                $this->messages->add(SIIE_PROCESS_OK);
                redirect(site_url('empresas/sucursales/'.$post['src_id_emp']),'refresh');
            }
        }

        $data['empresa'] = $this->empresas->getEmpresaById($emp_id);
        $data['sucursales'] = $this->empresas->getSucursalesByEmpresa($emp_id);
        $data['emp_id'] = $emp_id;
        $data['correlativo'] = $this->empresas->getUltimoCorrelativoSucursal($emp_id);

        $this->template->load('template','empresas/sucursales',$data);
    }

    function sucursal($src_id)
    {
        $this->load->helper('facturacion');

        $this->template->set('seccion','Gestor de Empresas - Configuración Sucursal');

        $data['sucursal'] = $this->empresas->getSucursalPorId($src_id);
        $data['puntos'] = $this->empresas->puntosPorSucursal($src_id);
        $data['src_id'] = $src_id;

        $emp_id = getEmpresaId();
        $data['usuarios'] = $this->empresas->getUsuariosPorEmpresaSesion($emp_id);

        $post = $this->input->post();

        if(!empty($post))
        {
            print_r($post);

            if($post['tipo'] == 1)
            {
                echo 'Datos Generales';
            }elseif($post['tipo'] == 2)
            {
                echo 'Punto de venta';
            }
            exit;

            /*$array = array(
                'pve_id_src' => $src_id,
                'pve_descripcion' => $post['pve_descripcion'],
            );

            $pve_id = $this->empresas->pvePorSucursalEmpresa($array);

            if($pve_id > 0)
            {
                foreach($post['multiUsusario'] as $l)
                {
                    $this->empresas->usuarioPorPuntoVenta($l,$pve_id);
                }
            }

            $this->messages->add(SIIE_PROCESS_OK);
            redirect(site_url('empresas/sucursal/'.$src_id),'refresh');*/
        }

        $this->template->load('template','empresas/sucursal',$data);

    }

    function datos_generales_src()
    {
        $post = $this->input->post();

        $this->empresas->insertaDatosGenralesSrc($post);

        $this->messages->add('Se ha insertado con exito los datos generales');
        redirect(site_url('empresas/sucursal/'.$post['src_id']));

    }

    function inserta_persona()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('per_primer_nombre', 'Primer Nombre', 'required');
        $this->form_validation->set_rules('per_segundo_nombre', 'Segundo Nombre', 'required');
        $this->form_validation->set_rules('per_primer_apellido', 'Primer Apellido', 'required');
        $this->form_validation->set_rules('per_segundo_apellido', 'Segundo Apellido', 'required');
        $this->form_validation->set_rules('per_dui', 'DUI', 'required');
        $this->form_validation->set_rules('per_nit', 'NIT', 'required');
        $this->form_validation->set_rules('per_fecha_nacimiento', 'Fecha de Nacimiento', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            redirect(site_url('empresas/personal/'.$post['emp_id']));
        }else{
            $data = array(
                'per_primer_nombre' => $post['per_primer_nombre'],
                'per_segundo_nombre' => $post['per_segundo_nombre'],
                'per_primer_apellido' => $post['per_primer_apellido'],
                'per_segundo_apellido' => $post['per_segundo_apellido'],
                'per_dui' => $post['per_dui'],
                'per_nit' => $post['per_nit'],
                'per_fecha_nacimiento' => $post['per_fecha_nacimiento'],
                'per_estado' => $post['per_estado'],
                'per_fecha_ingreso' => date('Y/m/d'),
            );

            $persona_id = $this->empresas->inseta_personal($data);
            if($persona_id > 0)
            {
                $data_uxe = array(
                    'pxe_id_emp' => $post['emp_id'],
                    'pxe_id_per' => $persona_id,
                );
                $this->empresas->inserta_personaxempresa($data_uxe);
            }

            $this->messages->add(SIIE_PROCESS_OK, "success");

            redirect(site_url('empresas/personal/'.$post['emp_id']),'refresh');
        }

    }

    function _grocery_output($output = null)
    {
        $this->template->load('template','empresas/index',$output);
        //$this->load->view('roles/index',$output);
    }

    function setPredetermianda($emp_id,$return="")
    {
        $return = base64_decode($return);

        $empresa = $this->empresas->getEmpresaById($emp_id);

        $sess_empresa = array(
            'usu_empresa' => $empresa[0]->emp_razon_social,
            'usu_emp_logo' => $empresa[0]->emp_logo,
            'usu_emp_id' => $empresa[0]->emp_id,
        );

        $this->session->set_userdata('ses_empresa', $sess_empresa);

        $sesion = $this->session->userdata('ses_empresa');

        $this->messages->add('Se ha establecido la empresa <b>'.$empresa[0]->emp_razon_social.'</b> como predeterminada.');

        redirect($return);
    }

    function empresas_usuario()
    {
        $this->template->set('seccion','Seleccion de Empresa - Empresa');

        $sesion = $this->session->userdata('ses_empresa');

        $usuario = getUsuarioId();
        $empresas = $this->empresas->getEmpresasUsuarioLogin($usuario);

        $data['empresas'] = $empresas;
        $this->template->load('template','empresas/empresas_usuario',$data);
    }
}