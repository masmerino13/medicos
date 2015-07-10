<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 5/19/14
 * Time: 10:05 PM
 */
class Empleados extends CI_Controller
{


    function __construct()
    {
        parent::__construct();

        $this->load->model('Empleados_Model');
    }

    function index()
    {
        $this->template->set('seccion','listado empleados');

        $this->template->load('template','empleados/lista');

    }
}