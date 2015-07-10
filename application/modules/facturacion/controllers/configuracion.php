<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 5/18/14
 * Time: 3:19 PM
 */
class Configuracion extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('fac_configuracion_model','configuracion');
        $this->load->helper('facturacion');
    }

    function index()
    {
        $this->template->set('seccion','Configuración');

        $emp_id = getEmpresaId();
        $mod_id = getModuloId();

        $data['config_general'] = $this->configuracion->getConfigElementos();
        $data['config_empresa'] = $this->configuracion->getConfigEmpresa($emp_id,$mod_id);

        $this->template->load('template','/configuracion/index',$data);
    }

    function guardar()
    {
        $mod_id = getModuloId();
        $emp_id = getEmpresaId();

        $post = $this->input->post();

        $elementos = $post['element'];
        foreach($elementos as $key => $row)
        {
            $this->configuracion->verificaConfigModulo($mod_id,$emp_id,$key,$row);
        }

        $this->messages->add('Se han registrado las configuraciones con exito');
        redirect(site_url('facturacion/configuracion'),'refresh');
    }

    function insertaAvanzadas($post)
    {

    }
}