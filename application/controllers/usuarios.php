<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/29/14
 * Time: 12:41 PM
 */

class Usuarios extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('usuarios_model','usuarios');
    }

    function ini()
    {
       $this->template->set('seccion','Gestor de Usuarios');
       $this->template->datatables();
       $this->template->toolbar('add','Nuevo Registro','usuarios/nuevo','Nuevo Usuario');

       $emp_id = getEmpresaId();

       $data['usuarios'] = $this->usuarios->getUsuarios($emp_id);

       $this->template->load('template','usuarios/index', $data);
    }

    function nuevo()
    {
        $this->template->set('seccion','Gestor de Empresas - Personal');

        $this->template->css('css/supr-theme/jquery.ui.dialog.css');
        $this->template->js('js/elements.js');
        $this->template->datatables();
        $this->template->formvalidation();
        $this->template->js('js/usuarios.js');

        $js = "$('#adminForm').validationEngine();";
        $this->template->addScript($js,1);

        $this->template->set('seccion','Gestor de Usuarios - Nuevo');

        $this->load->model('empresas_model','empresa');
        $this->load->model('roles_model','roles');

        $emp_id = getEmpresaId();

        $data['personal'] = $this->empresa->getEmpleadosByEmpresa($emp_id);
        $data['roles'] = $this->roles->getRoles();

        $post = $this->input->post();

        if(!empty($post))
        {
            $this->form_validation->set_rules('usr_login', 'Usuario', 'trim|required|min_length[5]|max_length[12]|xss_clean');
            $this->form_validation->set_rules('usr_contra', 'Contraseña', 'trim|required|matches[usr_contra2]|sha1');
            $this->form_validation->set_rules('usr_contra2', 'Validar contraseña', 'trim|required');
            $this->form_validation->set_rules('per_id', 'Persona', 'trim|required');
            $this->form_validation->set_rules('rol_id', 'Rol', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                $error = validation_errors();
                $this->messages->add($error,'error');
                redirect(site_url('usuarios/nuevo'));
            }else{
                $info = array(
                    'usr_id_per' => $post['per_id'],
                    'usr_id_rol' => $post['rol_id'],
                    'usr_login' => $post['usr_login'],
                    'usr_contra' => sha1($post['usr_contra']),
                    'usr_estado' => $post['usr_estado'],
                );

                $usuario_id = $this->usuarios->insertaUsuario($info);
                if($usuario_id > 0)
                {
                    $info_empresa = array(
                        'uxe_id_emp' => $emp_id,
                        'uxe_id_usr' => $usuario_id,
                    );

                    $info_persona = array(
                        'uxp_id_usr' => $usuario_id,
                        'uxp_id_per' => $post['per_id'],
                    );

                    $this->usuarios->insertaUsuarioPorEmpresa($info_empresa);
                    $this->usuarios->insertaUsuarioPorPersona($info_persona);

                    $this->messages->add(SIIE_PROCESS_OK);
                    redirect(site_url('usuarios/ini'),'refresh');
                }

            }
        }

        $this->template->load('template','usuarios/nuevo',$data);
    }
}