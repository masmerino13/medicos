<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/15/2015
 * Time: 8:11 PM
 */
class Citas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->template->set('seccion', 'Citas');
        $this->template->toolbar('add','','medicos/citas/nueva','Nueva cita');

        $data['citas'] = $this->consultas->getCitas();

        $this->template->load('template', 'citas/index', $data);
    }

    function nueva($pac_key="")
    {
        $this->template->set('seccion', 'Nueva cita');

        $this->template->load('template', 'citas/nueva');
    }
}