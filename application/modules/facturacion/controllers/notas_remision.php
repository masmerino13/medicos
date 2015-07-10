<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 9/29/14
 * Time: 5:21 PM
 */
class Notas_Remision extends MX_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('fac_notas_remision_model','remision');
        $this->load->helper('facturacion');
    }

    function index()
    {
        $this->template->set('seccion','Notas remisión');

        $emp_id = getEmpresaId();
        $data['remisiones'] = $this->remision->getRemisionesByEmpresa($emp_id);

        $this->template->load('template','/notas_remision/index', $data);
    }
}