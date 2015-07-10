<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 5/27/14
 * Time: 9:58 PM
 */

if(!function_exists('setCorrelativoFactura'))
{
    function setCorrelativoFactura()
    {
        $CI =& get_instance();
        $CI->load->model('facturacion/fac_facturacion_model','factura');

        return '0001';
    }
}

if(!function_exists('setCorrelativoSucursal'))
{
    function setCorrelativoSucursal($correlativo)
    {
        switch(strlen($correlativo)){
            case 1:
                $numero = '000000000'.$correlativo;
                break;
            case 2:
                $numero = '00000000'.$correlativo;
                break;
            case 3:
                $numero = '0000000'.$correlativo;
                break;
            case 4:
                $numero = '000000'.$correlativo;
                break;
            case 5:
                $numero = '00000'.$correlativo;
                break;
            case 6:
                $numero = '0000'.$correlativo;
                break;
            case 7:
                $numero = '000'.$correlativo;
                break;
            case 8:
                $numero = '00'.$correlativo;
                break;
            case 9:
                $numero = '0'.$correlativo;
                break;
            case 10:
                $numero = $correlativo;
                break;
        }

        return $numero;
    }
}

if(!function_exists('getPuntoVentaId'))
{
    function getPuntoVentaId()
    {
        $CI =& get_instance();
        $CI->load->library(array('session'));
        $punto = $CI->session->userdata('ses_puntoventa');

        if(!empty($punto))
        {
            return $punto['pve_id'];
        }

    }
}

if(!function_exists('getPuntoVentaDescripcion'))
{
    function getPuntoVentaDescripcion()
    {
        $CI =& get_instance();
        $CI->load->library(array('session'));
        $punto = $CI->session->userdata('ses_puntoventa');

        if(!empty($punto))
        {
            return $punto['pve_descripcion'];
        }

    }
}

if(!function_exists('getSucursalId'))
{
    function getSucursalId()
    {
        $CI =& get_instance();
        $CI->load->library(array('session'));
        $punto = $CI->session->userdata('ses_puntoventa');

        if(!empty($punto))
        {
            return $punto['pve_src_id'];
        }

    }
}

if(!function_exists('getSucursalDescripcion'))
{
    function getSucursalDescripcion()
    {
        $CI =& get_instance();
        $CI->load->library(array('session'));
        $punto = $CI->session->userdata('ses_puntoventa');

        if(!empty($punto))
        {
            return $punto['pve_src_descripcion'];
        }

    }
}