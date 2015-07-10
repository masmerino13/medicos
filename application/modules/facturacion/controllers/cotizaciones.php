<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 5/18/14
 * Time: 3:19 PM
 */
class Cotizaciones extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('fac_cotizaciones_model','cotizacion');
        $this->load->model('fac_clientes_model','clientes');
        $this->load->model('empresas_model','empresas');
        $this->load->model('periodos_model','periodos');
        $this->load->model('bodegas/inv_bodegas_model','bodegas');
        $this->load->model('fac_configuracion_model','configuracion');
        $this->load->helper('facturacion');
    }

    function index()
    {
        $this->template->set('seccion','Cotizaciones');
        $this->template->toolbar('add','Nueva cotización','facturacion/cotizaciones/nuevo','Nueva cotización');
        $this->template->toolbar('back','Regresar','#','Regresar');
        $this->load->helper('cotizaciones');
        $this->template->datatables();

        $emp_id = getEmpresaId();
        $data['cotizaciones'] = $this->cotizacion->getCotizacionesEmpresa($emp_id);
        $this->template->load('template','/cotizaciones/index',$data);
    }

    function nuevo()
    {
        $this->load->model('fac_vendedores_model','vendedores');

        $this->template->set('seccion','Cotizaciones - Nueva cotización');
        $this->template->datatables();
        $this->template->toolbar('back');

        $this->template->js('plugins/forms/maskedinput/jquery.maskedinput-1.3.min.js');
        $this->template->js('js/facturacion/cotizacion.js');
        $this->template->js('js/jquery.number.min.js');
        $this->template->formvalidation();
        $script = "
        $('#efa_total').number(true, 2);
        $('.number_format').number(true, 2);
        ";
        $this->template->addScript($script);
        $this->template->exitConfirm();

        $script = "$('#adminForm').validationEngine();";
        $this->template->addScript($script);

        $emp_id = getEmpresaId();
        $mod_id = getModuloId();
        $usr_id = getUsuarioId();
        $anio = getAnioPeriodoFical();
        $src_id = getSucursalId();
        $pve_id = getPuntoVentaId();

        $data['empresa'] = $this->empresas->getEmpresaById($emp_id);
        $data['clientes'] = $this->clientes->getClientesByEmpresas($emp_id);
        $data['periodos'] = $this->periodos->getPeriodosFiscales();
        $data['periodo'] = getPeriodoFical();
        $data['pef_id'] = getIdPeriodoFical();
        $data['emp_id'] = $emp_id;
        $data['bodegas'] = $this->bodegas->getBodegasByEmpresas();
        $data['codigo_factura'] = $this->cotizacion->correlativoCotizacion($anio, $emp_id);
        $data['sucursales'] = $this->cotizacion->getSucursalesUsrEmp($emp_id,$usr_id);
        $data['config'] = $this->configuracion->getConfigEmpresa($emp_id,$mod_id);
        $data['vendedores'] = $this->vendedores->getVendedoresEmpresa($emp_id,$src_id,$pve_id);

        $this->template->load('template','/cotizaciones/nueva',$data);
    }

    function detalle_cotizacion($ect_id)
    {
        $this->template->set('seccion','Cotizaciones - Detalle cotización');
        $this->template->toolbar('edit','Editar','facturacion/cotizaciones/editar/'.$ect_id,'Editar');
        $params = array('label'=>'Factura','url'=>'facturacion/facturar/nuevo/'.$ect_id,'icon'=>'icomoon-icon-cart ');
        $this->template->toolbar('custom',$params);
        $params = array('label'=>'Credito fiscal','url'=>'facturacion/facturar/nuevo_credito_fiscal/'.$ect_id,'icon'=>'icomoon-icon-cart ');
        $this->template->toolbar('custom',$params);
        $this->template->toolbar('back','Regresar','#','Regresar');
        $this->load->helper('cotizaciones');

        $data['cotizacion'] = $this->cotizacion->getEncabezadoCotizacion($ect_id);
        $data['articulos'] = $this->cotizacion->getDetalleCotizacion($ect_id, 3);
        $this->template->load('template','/cotizaciones/detalle',$data);
    }

    function inserta_cotizacion(){
        $post = $this->input->post();

        $encabezado = array(
            'ect_id_cli' => $post['efa_id_cli'],
            'ect_id_usr' => getUsuarioId(),
            'ect_id_src' => $post['efa_id_src'],
            'ect_id_pve' => $post['efa_id_pve'],
            'ect_id_vxe' => $post['efa_id_vxe'],
            'ect_correlativo' => $post['correlativo'],
            'ect_fecha' => date('Y/m/d h:i:s'),
            'ect_fecha_documento' => $post['ect_fecha_documento'],
            'ect_anio' => date('Y', strtotime($post['ect_fecha_documento'])),
            'ect_mes' => date('m', strtotime($post['ect_fecha_documento'])),
            'ect_sumas' => str_replace(',','',$post['sumas']),
            'ect_iva' => str_replace(',','',$post['ecf_iva']),
            'ect_total' => str_replace(',','',$post['efa_total']),
            'ect_estado' => 1,
        );

        $insert_id = $this->cotizacion->insertaEncabezadoCotizacion($encabezado);

        if($insert_id > 0)
        {
            $articulos = $post['articulo'];
            foreach($articulos as $key => $row){
                $art = array(
                    'dct_id_ect' => $insert_id,
                    'dct_id_bod' => $articulos[$key]['bodega'],
                    'dct_id_art' => $key,
                    'dct_cantidad' => $articulos[$key]['cant'],
                    'dct_precio' => $articulos[$key]['precio'],
                    'dct_monto' => ($articulos[$key]['cant']) * ($articulos[$key]['precio']),
                );
                $this->cotizacion->insertaDetalleCotizacion($art);
            }
            $this->messages->add('Se ha registrado la cotización <b>'.$post['correlativo'].'</b> con exito.');
            redirect(site_url('facturacion/cotizaciones/detalle_cotizacion/'.$insert_id),'refresh');
        }else{
            $this->messages->add('Fallo registro de credito fiscal','error');
            redirect(site_url('facturacion/cotizaciones/nuevo'),'refresh');
        }
    }

    function validaCorrelativoCotizacion()
    {
        $codigoCotizacion=$_REQUEST['fieldValue'];
        $validateId=$_REQUEST['fieldId'];

        $arrayToJs = array();
        $arrayToJs[0] = $validateId;

        $n = $this->cotizacion->validaCodigoCotizacionPorEmpresa($codigoCotizacion);

        if(!empty($n))
        {
            if($n[0]->n > 0)
            {
                $arrayToJs[1] = false;
                echo json_encode($arrayToJs);
            }else{
                $arrayToJs[1] = true;			// RETURN TRUE
                echo json_encode($arrayToJs);
            }
        }else{
            $arrayToJs[1] = false;
            echo json_encode($arrayToJs);
        }


    }

}