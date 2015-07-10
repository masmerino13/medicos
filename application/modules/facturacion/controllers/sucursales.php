<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 5/18/14
 * Time: 3:19 PM
 */
class Sucursales extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('fac_facturacion_model','facturacion');
        $this->load->helper('facturacion');
    }

    function seleccion()
    {
        $this->template->set('seccion','Sucursales');

        $emp_id = getEmpresaId();
        $usr_id = getUsuarioId();
        $data['sucursales'] = $this->facturacion->getSucursalesUsrEmp($emp_id,$usr_id);
        $data['modelo'] = $this->facturacion;

        $this->template->load('template','sucursales/seleccion',$data);
    }

    function setPuntoVenta($pve_id)
    {
        $punto = $this->facturacion->getPuntoVenta($pve_id);
        if(!empty($punto))
        {
            $sess_puntoventa = array(
                'pve_id' => $pve_id,
                'pve_descripcion' => $punto[0]->pve_descripcion,
                'pve_src_id' => $punto[0]->src_id,
                'pve_src_descripcion' => $punto[0]->src_descripcion,
            );

            $this->session->set_userdata('ses_puntoventa', $sess_puntoventa);

            $this->messages->add('Se ha establecido el punto de venta <b>'.$punto[0]->pve_descripcion.'</b> de la sucursal <b>'.$punto[0]->src_descripcion.'</b> como predeterminado.');

            redirect(site_url('facturacion/index'),'refresh');
        }else
        {
            $this->messages->add('No ha seleccionado un puntop de venta valido.','error');
            redirect(site_url('facturacion/sucursales/seleccion'),'refresh');
        }

    }
}