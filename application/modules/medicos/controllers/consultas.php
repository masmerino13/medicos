<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 1/18/2015
 * Time: 3:31 PM
 */
class Consultas extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('med_pacientes_model', 'pacientes');
        $this->load->model('med_formularios_model', 'forms');
        $this->load->model('med_consultas_model', 'consultas');
    }

    function index()
    {
        $this->template->set('seccion', 'Consultas medicas');
        $this->template->datatables();
        $this->template->toolbar('add','','medicos/consultas/nueva','Nueva consulta medica');

        $data['consultas'] = $this->consultas->getConsultas();

        $this->template->load('template', 'consultas/index', $data);
    }

    function nueva()
    {
        $this->template->set('seccion', 'Realizar consulta medica');
        $this->template->js('js/medicos/consultas.js');
        $this->template->datatables();

        $emp_id = getEmpresaId();
        $forms = $this->forms->getFormulariosConsulta($emp_id);
        if(empty($forms))
            $this->messages->add('Debe ingresar formularios para poder realizar consultas medicas', 'error');

        $data['forms'] = $forms;
        $data['pacientes'] = $this->pacientes->getPacientesConsultorio($emp_id);

        $this->messages->add('Debe seleccionar un paciente para realizar una consulta medica.');

        $this->template->load('template', 'consultas/nuevo', $data);
    }

    function seleccion_form($pac_key)
    {
        $this->template->set('seccion', 'Realizar consulta medica - seleccionar formulario a usar');
        $this->template->toolbar('back');
        $this->template->datatables();

        $emp_id = getEmpresaId();
        $forms = $this->forms->getFormulariosConsulta($emp_id);
        if(empty($forms))
            $this->messages->add('Debe ingresar formularios para poder realizar consultas medicas', 'error');

        $data['pac_key'] = $pac_key;
        $data['forms'] = $forms;
        $data['paciente'] = $this->pacientes->getPacienteConsultorio($emp_id, $pac_key);
        $this->template->load('template', 'consultas/formularios', $data);
    }

    function realizar($pac_key,$form_id)
    {
        $this->load->helper('med_forms');
        $params = array(
            'id' => 'openDialogFicha',
            'label' => 'Ficha paciente',
            'icon' => 'icomoon-icon-vcard '
        );
        $this->template->toolbar('customJs',$params);
        $historial = array(
            'id' => 'openDialogHistorial',
            'label' => 'Historial medico',
            'icon' => 'icomoon-icon-history'
        );
        $this->template->toolbar('customJs',$historial);
        $this->template->toolbar('back');
        $this->template->js('js/medicos/realiza_consulta.js');

        $post = $this->input->post();
        $emp_id = getEmpresaId();
        if(!empty($post))
        {
            $pac_id = $post['paciente_code'];
            $params_h = array($pac_id, $emp_id,$form_id);
            $response = $this->forms->insertaEncabezadoConsulta($params_h);
            if(!empty($post['formElement']))
            {
                foreach($post['formElement'] as $id => $elemento)
                {
                    $data = array(
                        $pac_id,
                        $response[0]->insertid,
                        $id,
                        $elemento
                    );
                    $this->forms->insertaFormularioPaciente($data);
                }
            }

            if($response[0]->insertid > 0)
            {
                redirect(site_url('medicos/consultas/consulta_detalle/'.$response[0]->insertid));
            }
        }

        $forms = $this->forms->getFormulariosConsulta($emp_id);
        if(empty($forms))
            $this->messages->add('Debe ingresar formularios para poder realizar consultas medicas', 'error');

        $formulario = $this->forms->getFormularioEncabezado($form_id);
        $this->template->set('seccion', 'Consulta a realizar: '.$formulario[0]->fxc_titulo);

        $data['model'] = $this->forms;
        $data['pac_key'] = $pac_key;
        $data['form_id'] = $form_id;
        $data['forms'] = $forms;
        $data['grupos'] = $this->forms->getElelentoFormularioPorTipo(5, $form_id);
        $data['paciente'] = $this->pacientes->getPacienteConsultorio($emp_id, $pac_key);
        $this->template->load('template', 'consultas/realizar_index', $data);
    }
}