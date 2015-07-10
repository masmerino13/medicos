<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 12/1/14
 * Time: 8:08 PM
 */
class Pacientes extends MX_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('med_pacientes_model', 'pacientes');
    }

    public function index(){
        $this->template->set('seccion', 'Pacientes');
        $this->template->toolbar('add','Nuevo Paciente','medicos/pacientes/nuevo','Nuevo Paciente');

        $emp_id = getEmpresaId();
        $data['pacientes'] = $this->pacientes->getPacientesConsultorio($emp_id);
        $this->template->load('template', 'pacientes/index', $data);
    }

    public function nuevo(){
        $this->template->set('seccion', 'Pacientes - Nuevo');
        $this->template->js('js/medicos/pacientes.js');
        $this->template->toolbar('back');
        $this->template->formvalidation();
        $script = '$(document).ready(function() {
                $("#adminForm").validationEngine();
            });';
        $this->template->addScript($script);

        $post = $this->input->post();
        if(!empty($post))
        {
            $this->form_validation->set_rules('pac_primer_nombre', 'Primer nombre', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('pac_primer_apellido', 'Primer apellido', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('pac_fecha_nacimiento', 'Fecha de nacimiento', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('pac_direccion', 'Dirección', 'trim|required|xss_clean');
            $this->form_validation->set_rules('pac_diagnostico', 'Diagnostico', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE)
            {
                $error = validation_errors();
                $this->messages->add($error,'error');
                redirect(site_url('medicos/pacientes/nuevo'));
            }else{
                $response = $this->pacientes->insertaPaciente($post);
                if($response[0]->insertid > 0){
                    $this->messages->add(SIIE_PROCESS_OK);
                    redirect(site_url('medicos/pacientes/perfil/'.$response[0]->pac_key));
                }else{
                    $this->messages->add('Fallo en el registro','error');
                    redirect(site_url('medicos/pacientes/nuevo'));
                }
            }
        }

        $this->template->load('template', 'pacientes/nuevo');
    }

    function perfil($pac_key)
    {
        $this->template->set('seccion', 'Pacientes - Perfil');
        $this->template->js('js/medicos/pacientes_perfil.js');
        $this->template->toolbar('edit','', 'medicos/pacientes/editar/'.$pac_key,'Editar paciente');
        $this->template->toolbar('back');

        $emp_id = getEmpresaId();
        $paciente = $this->pacientes->getPacienteConsultorio($emp_id,$pac_key);
        if(empty($paciente))
        {
            $this->messages->add('Debe seleccionar un paciente valido', 'error');
            redirect(site_url('medicos/pacientes'));
        }

        $data['paciente'] = $paciente;
        $this->template->load('template', 'pacientes/perfil', $data);
    }
}