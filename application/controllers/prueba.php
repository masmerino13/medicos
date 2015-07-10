<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 5/14/14
 * Time: 10:55 PM
 */
class Prueba extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('prueba');
        $this->load->model('empresas_model','alias');
    }

    function nuevo()
    {
        $this->template->set('seccion','Probando insert');
        $this->template->datatables();

        $volados['pruebas'] = $this->alias->listaPruebas();

        $fomulario = $this->input->post();
        if(!empty($fomulario))
        {
            $datos = array(
                'nombres' => $fomulario['nombres'],
                'apellidos' => $fomulario['apellidos'],
                'fecha_nac' => $fomulario['fecha_nac'],

            );
            if($this->alias->insertaPrueba($datos))
            {
                $this->messages->add('Se inserto la prueba con exito');
                redirect(site_url('prueba/nuevo'));
            }
        }

        $this->template->load('template', 'prueba_form',$volados);
    }
    function ini()
    {
        $this->template->set('seccion','Area de prueba');

        $this->template->load('template','prueba');
    }

    function otro(){
        $this->template->set('seccion','Area de otro');
        $this->template->datatables();

        $emp_id = getEmpresaId();
        $valores['empresa'] = $this->empresa->getEmpleadosByEmpresa($emp_id);

        $valores['nombre'] = 'Ricardo Merino';

        $this->template->load('template','prueba',$valores);
    }
}