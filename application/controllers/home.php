<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/15/14
 * Time: 6:02 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        if($this->session->userdata('logged_in'))
        {
            /*Charts plugins*/
            $this->template->js('plugins/charts/flot/jquery.flot.js');
            $this->template->js('plugins/charts/flot/jquery.flot.grow.js');
            $this->template->js('plugins/charts/flot/jquery.flot.pie.js');
            $this->template->js('plugins/charts/flot/jquery.flot.resize.js');
            $this->template->js('plugins/charts/flot/jquery.flot.tooltip_0.4.4.js');
            $this->template->js('plugins/charts/flot/jquery.flot.orderBars.js');
            $this->template->js('plugins/charts/sparkline/jquery.sparkline.min.js');
            $this->template->js('plugins/charts/knob/jquery.knob.js');
            $this->template->js('js/dashboard.js');

            $session_data = $this->session->userdata('logged_in');
            $data['usu_login'] = $session_data['usu_login'];

            $this->template->set('seccion','Panel de control');

            $data['home'] = 1;
            $this->template->load('template','panel',$data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('home', 'refresh');
    }

}