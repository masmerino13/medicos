<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/12/14
 * Time: 8:00 PM
 */
session_start();
class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $session = $this->session->userdata('logged_in');
        if($session['usu_id'] > 0 )
        {
            redirect('home', 'refresh');
        }else{
            $this->load->view('login_view');
        }
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('ses_empresa');
        $this->session->unset_userdata('ses_puntoventa');
        $this->session->unset_userdata('modulo_actual');
        session_destroy();
        redirect('login', 'refresh');
    }
}
?>