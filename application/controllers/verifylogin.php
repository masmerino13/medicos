<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/12/14
 * Time: 9:07 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Verifylogin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('usuario_model','usuario');
        $this->load->model('empresas_model','empresas');
        $this->load->model('periodos_model','periodos');
    }

    function index()
    {
        $this->form_validation->set_rules('usr_login', 'Usuario', 'trim|required|xss_clean');
        $this->form_validation->set_rules('usr_contra', 'Contraseña', 'trim|required|xss_clean|callback_check_database');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('login_view');
        }else{
            $usuario = getUsuarioId();

            $empresas = $this->empresas->getEmpresasUsuarioLogin($usuario);
            if(count($empresas) > 1)
            {
                $this->messages->add('<b>Aviso!</b> Su usuario esta asignado a mas de una empresa<br>Debe seleccionar una como predeterminada.','alert');
                redirect(site_url('empresas/empresas_usuario'));
            }else{
                redirect('home', 'refresh');
            }

            redirect('home', 'refresh');

        }
    }

    function check_database($password)
     {
       $username = $this->input->post('usr_login');
       $result = $this->usuario->getUsuario($username, $password);

       if($result)
       {
           if($result[0]->usr_id > 0)
           {
               $credenciales = $this->usuario->getCredencialesInicio($result[0]->usr_id);

               $sess_array = array();

                   $sess_array = array(
                       'usu_id' => $result[0]->usr_id,
                       'usu_login' => $result[0]->usr_login,
                       'usu_rol_id' => $credenciales[0]->rol_id,
                       'usu_persona' => $credenciales[0]->persona,
                       'usu_per_id' => $credenciales[0]->per_id,
                   );

                   $empresas = $this->empresas->getEmpresasUsuarioLogin($result[0]->usr_id);

                   if(count($empresas) == 1){
                       $sess_empresa = array(
                           'usu_empresa' => $empresas[0]->emp_razon_social,
                           'usu_emp_logo' => $empresas[0]->emp_logo,
                           'usu_emp_id' => $empresas[0]->emp_id,
                       );
                       $this->session->set_userdata('ses_empresa', $sess_empresa);
                   }

                   $this->session->set_userdata('logged_in', $sess_array);

               $modulos = $this->usuario->getModulosPorUsuario($result[0]->usr_id);
               if(!empty($modulos) > 0){
                   $moduloData = array(
                       'mod_nombre'  => $modulos[0]->mod_titulo,
                       'mod_id'     => $modulos[0]->mod_id,
                       'mod_tema' => 'default'
                   );

                   $this->session->set_userdata('modulo_actual', $moduloData);
               }

               $periodo = $this->periodos->getPeriodoActivo();
               if(!empty($periodo) > 0)
               {
                   $sess_array = array(
                       'per_codigo' => $periodo[0]->pef_id,
                       'per_mes' => $periodo[0]->pef_mes,
                       'per_anio' => $periodo[0]->pef_anio,
                   );

                   $this->session->set_userdata('ses_periodo', $sess_array);
               }
           }
         return TRUE;
       }
       else
       {
         $this->form_validation->set_message('check_database', 'Usuario o contraseña no validos');
         return false;
       }
     }

}