<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 1/17/2015
 * Time: 7:39 PM
 */
class Forms extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('med_formularios_model', 'forms');
    }

    function index()
    {
        $this->template->set('seccion', 'Formularios consulta medica');
        $this->template->toolbar('add','Nuevo formulario','medicos/forms/nuevo','Nuevo formulario');

        $emp_id = getEmpresaId();
        $forms = $this->forms->getFormulariosConsulta($emp_id);
        if(empty($forms))
            $this->messages->add('Debe ingresar formularios para poder realizar consultas medicas', 'error');

        $data['forms'] = $forms;
        $this->template->load('template', 'formularios/index', $data);
    }

    function nuevo()
    {
        $this->template->set('seccion', 'Formularios consulta medica - Nuevo');
        $this->template->toolbar('back');
        $this->template->formvalidation();
        $script = '$(document).ready(function() {
                $("#adminForm").validationEngine();
            });';
        $this->template->addScript($script);

        $post = $this->input->post();
        if(!empty($post))
        {
            $this->form_validation->set_rules('fxc_titulo', 'Titulo', 'trim|required|max_length[128]|xss_clean');
            if ($this->form_validation->run() == FALSE)
            {
                $error = validation_errors();
                $this->messages->add($error,'error');
                redirect(site_url('medicos/forms/nuevo'));
            }else{
                $response = $this->forms->insertaForm($post);
                if($response[0]->insertid > 0){
                    $this->messages->add(SIIE_PROCESS_OK);
                    redirect(site_url('medicos/forms/elementos/'.$response[0]->insertid));
                }else{
                    $this->messages->add('Fallo en el registro','error');
                    redirect(site_url('medicos/forms/nuevo'));
                }
            }
        }
        $this->template->load('template', 'formularios/nuevo');
    }

    function elementos($form_id)
    {
        $this->load->helper('med_forms');
        $this->template->set('seccion', 'Formularios consulta medica - Elementos');
        $this->template->toolbar('back');
        $this->template->formvalidation();
        $script = '$(document).ready(function() {
                $("#adminForm").validationEngine();
            });';
        $this->template->addScript($script);

        $post = $this->input->post();
        if(!empty($post))
        {
            $this->form_validation->set_rules('exf_label', 'Titulo', 'trim|required|max_length[64]|xss_clean');
            $this->form_validation->set_rules('exf_tipo', 'Tipo elemento', 'trim|required|max_length[64]|xss_clean');

            if ($this->form_validation->run() == FALSE)
            {
                $error = validation_errors();
                $this->messages->add($error,'error');
                redirect(site_url('medicos/forms/elementos/'.$form_id));
            }elseif($post['exf_grupo'] > 0 && $post['exf_tipo'] == 5){
                $this->messages->add('No es posible agrupar un grupo dentro de otro.','error');
                redirect(site_url('medicos/forms/elementos/'.$form_id));
            }else{
                $post['fxc_id'] = $form_id;
                $this->forms->insertaElementoForm($post);
                $this->messages->add(SIIE_PROCESS_OK);

                redirect(site_url('medicos/forms/elementos/'.$form_id));
            }
        }

        $data['form_id'] = $form_id;
        $data['tipos'] = $this->forms->getTiposElementos();
        $data['grupos'] = $this->forms->getElelentoFormularioPorTipo(5, $form_id);
        $data['socios'] = $this->forms->getElelentoFormularioPorTipo(0,$form_id);
        $data['model'] = $this->forms;

        $this->template->load('template', 'formularios/elementos', $data);
    }
}