<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 5/5/14
 * Time: 8:16 PM
 */
if (!defined( 'BASEPATH')) exit('No direct script access allowed');
class Validator
{
    private $ci;
    public function __construct()
    {
        $this->ci =& get_instance();
        !$this->ci->load->model('periodos_model') ? $this->ci->load->model('periodos_model') : false;
        !$this->ci->load->model('empresas_model') ? $this->ci->load->model('empresas_model') : false;
        !$this->ci->load->library('session') ? $this->ci->load->library('session') : false;
        !$this->ci->load->library('messages') ? $this->ci->load->library('messages') : false;
    }

    public function check_periodo_fiscal()
    {
        /* = $this->ci->core_model->getPeridoFiscalActual();
        $periodo = $periodos[0];
        if($periodo > 0)
        {

		}*/
        //$this->ci->messages->add('<strong>Aviso! </strong>No se ha definido ningun periodo fiscal en el sistema.','error');
	}

    function check_exiten_periodos()
    {
        $periodos = $this->ci->periodos_model->getPeriodosFiscales();

        if(empty($periodos)){
            $this->ci->messages->add('<strong>Aviso! </strong>No se ha definido ningun periodo fiscal en el sistema.','error');
        }

    }

    function check_empresas_usuario()
    {
        $usuario = getUsuarioId();
        $empresas = $this->ci->empresas_model->getEmpresasUsuarioLogin($usuario);

        $uri = uri_string();

        $partes = explode('/',$uri);

        $sesion = $this->ci->session->userdata('ses_empresa');
        if(empty($sesion['usu_emp_id'])){
        if($uri == 'login/logout' ){}elseif(@$partes[1] == 'setPredetermianda'){}else{
        if(count($empresas) > 1 && $uri != 'empresas/empresas_usuario')
        {
            $this->ci->messages->add('<b>Aviso!</b> Su usuario esta asignado a mas de una empresa<br>Debe seleccionar una como predeterminada.','alert');
            redirect('empresas/empresas_usuario','refresh');
        }
        }
        }
    }

    function check_modulo()
    {
        $CI =& get_instance();
        $CI->load->library(array('session'));
        $modulo = $CI->session->userdata('modulo_actual');
        $punto_venta = $CI->session->userdata('ses_puntoventa');

        $uri = uri_string();
        $partes = explode('/',$uri);

        if(@$modulo['mod_id'] == 2)
        {
            if(empty($punto_venta)){
                @$cambio_url = $partes[0].'/'.$partes[1].'/'.$partes[2];
                if($uri == 'facturacion/sucursales/seleccion'){}elseif($uri == 'login/logout'){}elseif($uri == 'login/logout'){}elseif($uri == 'facturacion/sucursales/setPuntoVenta'){}elseif($cambio_url == 'facturacion/sucursales/setPuntoVenta'){}else{


                        $this->ci->messages->add('<b>Aviso!</b> Debe seleccionar una sucursal y punto de venta antes de continuar.','alert');
                        redirect(site_url('facturacion/sucursales/seleccion'),'refresh');
                    }
            }
        }

        /*if(@$partes[0] == 'facturacion' ){}elseif($uri == 'login/logout' ){

        }else{

        }*/

    }
}
/*
/end hooks/home.php
*/