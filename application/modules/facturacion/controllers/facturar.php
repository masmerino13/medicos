<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 5/18/14
 * Time: 3:19 PM
 */
class Facturar extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('fac_facturacion_model','facturacion');
        $this->load->model('fac_clientes_model','clientes');
        $this->load->model('empresas_model','empresas');
        $this->load->model('periodos_model','periodos');
        $this->load->model('bodegas/inv_bodegas_model','bodegas');
        $this->load->model('fac_configuracion_model','configuracion');
        $this->load->model('fac_vendedores_model','vendedores');
        $this->load->helper('facturacion');
    }

    function index()
    {
        $this->template->set('seccion','Facturación');

        $usr_id = getUsuarioId();
        $mod_id = getModuloId();
        $item_id = getItemId();
        $data['iconos'] = $this->facturacion->getIconosPanelFacturar($usr_id,$mod_id,$item_id);

        $this->template->load('template','/facturacion/index',$data);
    }

    function factura_comercial()
    {
        $this->template->set('seccion','Facturas comerciales');
        $this->template->datatables();

        $this->template->toolbar('add','Nueva factura','facturacion/facturar/nuevo','Nueva factura');
        $this->template->toolbar('back','Regresar','#','Regresar');

        $emp_id = getEmpresaId();

        $data['facturas'] = $this->facturacion->getFacturasEmpresa($emp_id);

        $this->template->load('template','/facturacion/facturas_comerciales',$data);
    }

    function nuevo($ect_id=0)
    {
        $this->template->set('seccion','Facturación - Nueva factura comercial');
        $this->template->datatables();
        $this->template->toolbar('back');

        $this->template->js('js/factura.js');
        $this->template->js('js/jquery.number.min.js');
        $this->template->formvalidation();
        $script = "
        $('#efa_total').number(true, 2);
        $('.number_format').number(true, 2);
        ";
        $this->template->addScript($script);
        $script = "$('#adminFormFacturaNueva').validationEngine();";
        $this->template->addScript($script);
        //$this->template->exitConfirm();

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
        $data['codigo_factura'] = $this->facturacion->correlativoFactura($anio, $emp_id, $mod_id);
        $data['sucursales'] = $this->facturacion->getSucursalesUsrEmp($emp_id,$usr_id);
        $data['config'] = $this->configuracion->getConfigEmpresa($emp_id,$mod_id);
        $data['vendedores'] = $this->vendedores->getVendedoresEmpresa($emp_id,$src_id,$pve_id);

        $rutaValidaFecha = 'validaFechaFactura';
        $rutaValidaCodigo = 'validaCodigoFactura';
        /*VERIFICAMOS SI VIENE COTIZACION Y EXISTE PARA LA EMPRESA*/
        if($ect_id > 0)
        {
            $this->load->model('fac_cotizaciones_model', 'cotizaciones');
            $cotiza = $this->cotizaciones->getEncabezadoCotizacion($ect_id);
            if(!empty($cotiza)){
                $this->messages->add('Se esta generando una factura apartir de la cotizacion <strong>'.$cotiza[0]->ect_correlativo.'</strong>', 'alert');
                $data['cotizacion'] = $cotiza;
                $data['articulos_cotizacion'] = $this->cotizaciones->getDetalleCotizacion($ect_id,1);
            }else{
                $this->messages->add('Esta intentando generar una factura apartir de una cotización que no existe.', 'error');
            }

            $rutaValidaFecha = '../validaFechaFactura';
            $rutaValidaCodigo = '../validaCodigoFactura';
        }

        $data['rutaValidaFecha'] = $rutaValidaFecha;
        $data['rutaValidaCodigo'] = $rutaValidaCodigo;

        $this->template->load('template','/facturacion/nueva',$data);
    }

    function validaFechaFactura()
    {
        /* RECEIVE VALUE */
        $fechaCliente=$_REQUEST['fieldValue'];
        $validateId=$_REQUEST['fieldId'];
        $per_id=$_REQUEST['efa_id_pef'];

        $periodo = $this->periodos->getPeriodoById($per_id);

        $arrayToJs = array();
        $arrayToJs[0] = $validateId;

        if(!empty($periodo))
        {
            $periodoMes = $periodo[0]->pef_mes;
            $periodoAnio = $periodo[0]->pef_anio;

            $timestampInicio = mktime(0, 0, 0, $periodoMes, 1, $periodoAnio); //Desde que fecha
            $timestampFin = mktime(0, 0, 0, $periodoMes, 31, $periodoAnio); //Hasta que fecha

            list($anio, $mes, $dia) = explode('/', $fechaCliente);

            $timestampCliente = mktime(0, 0, 0, $mes, $dia, $anio);
            if($timestampCliente >= $timestampInicio && $timestampCliente <= $timestampFin) {
                $arrayToJs[1] = true;			// RETURN TRUE
                echo json_encode($arrayToJs);
            }else{
                $arrayToJs[1] = false;
                echo json_encode($arrayToJs);

            }
        }else{
            $arrayToJs[1] = false;
            echo json_encode($arrayToJs);
        }
    }

    /*
     * VALIDA FECHA ENTRE PERIODO
     *
    function validaFechaFactura()
    {
        $fechaCliente=$_REQUEST['fieldValue'];
        $validateId=$_REQUEST['fieldId'];
        $per_id=$_REQUEST['efa_id_pef'];

        $periodo = $this->periodos->getPeriodoById($per_id);

        $arrayToJs = array();
        $arrayToJs[0] = $validateId;

        if(!empty($periodo))
        {
            $periodoMes = $periodo[0]->pef_mes;
            $periodoAnio = $periodo[0]->pef_anio;
            switch($periodoMes){
                case 1:
                    $Lmes = 11;
                    $Lanio = $periodoAnio - 1;
                    break;
                case 2:
                    $Lmes = 12;
                    $Lanio = $periodoAnio - 1;
                    break;
                default:
                    $Lmes = $periodoMes - 2;
                    $Lanio = $periodoAnio;
                    break;
            }

            $timestampInicio = mktime(0, 0, 0, $Lmes, 1, $Lanio); //Desde que fecha
            $timestampFin = mktime(0, 0, 0, $periodoMes, 31, $periodoAnio); //Hasta que fecha

            list($mes, $dia, $anio) = explode('/', $fechaCliente);
            $timestampCliente = mktime(0, 0, 0, $mes, $dia, $anio);
            if($timestampCliente >= $timestampInicio && $timestampCliente <= $timestampFin) {
                $arrayToJs[1] = true;			// RETURN TRUE
                echo json_encode($arrayToJs);
            }else{
                $arrayToJs[1] = false;
                echo json_encode($arrayToJs);

            }
        }else{
            $arrayToJs[1] = false;
            echo json_encode($arrayToJs);
        }
    }*/

    function validaCodigoFactura()
    {
        $codigoFactura=$_REQUEST['fieldValue'];
        $validateId=$_REQUEST['fieldId'];

        $arrayToJs = array();
        $arrayToJs[0] = $validateId;

        $n = $this->facturacion->validaCodigoFacturaPorEmpresa($codigoFactura);

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

    function inserta_factura()
    {
        $post = $this->input->post();

        $encabezado = array(
            'efa_id_usr' => getUsuarioId(),
            'efa_id_cli' => $post['efa_id_cli'],
            'efa_id_pef' => $post['efa_id_pef'],
            'efa_id_pve' => $post['efa_id_pve'],
            'efa_id_src' => $post['efa_id_src'],
            'efa_id_vxe' => $post['efa_id_vxe'],
            'efa_fecha' => date('Y/m/d h:i:s'),
            'efa_codigo_factura' => $post['correlativo'],
            'efa_fecha_factura' => $post['efa_fecha_factura'],
            'efa_anio' => date('Y', strtotime($post['efa_fecha_factura'])),
            'efa_mes' => date('m', strtotime($post['efa_fecha_factura'])),
            'efa_monto' => $post['efa_total'],
        );

        $insert_id = $this->facturacion->insertaEncabezadoFactura($encabezado);

        if($insert_id > 0)
        {
            $articulos = $post['articulo'];
            foreach($articulos as $key => $row){
                $art = array(
                    'dfa_id_efa' => $insert_id,
                    'dfa_id_art' => $key,
                    'dfa_cantidad' => $articulos[$key]['cant'],
                    'dfa_precio' => $articulos[$key]['precio'],
                    'dfa_monto' => ($articulos[$key]['cant']) * ($articulos[$key]['precio']),
                    'efa_id_pef' => $post['efa_id_pef'],
                    'efa_codigo_factura' => $post['correlativo'],
                    'efa_fecha_factura' => $post['efa_fecha_factura'],
                    'efa_fecha' => date('Y/m/d h:i:s'),
                    'bod_id' => $articulos[$key]['bodega'],
                );

                $this->facturacion->insertaDetalleFactura($art);
            }

            $this->messages->add('Se ha registrado la factura <b>'.$post['correlativo'].'</b> con exito.');
            redirect(site_url('facturacion/facturar/nuevo'),'refresh');
        }

    }

    function detalle_factura($efa_codigo)
    {
        $this->template->set('seccion','Detalle factura');
        $this->template->toolbar('print','Imprimir','#','Imprimir');
        $this->template->toolbar('back','Regresar','#','Regresar');

        $efa_codigo = setDecode($efa_codigo);
        $emp_id = getEmpresaId();
        $factura = $this->facturacion->getEncabezadoFactura($efa_codigo);
        if(empty($factura)):
            $this->messages->add('No ha seleccionado una factura valida','error');
            redirect(site_url('facturacion/facturar/factura_comercial'));
            endif;

        $data['factura'] = $factura;
        $data['items_factura'] = $this->facturacion->getDetalleFactura($efa_codigo);
        $data['empresa'] = $this->empresas->getEmpresaById($emp_id);

        $this->template->load('template','/facturacion/detalle_factura',$data);
    }

    function articulos_bodega()
    {
        $bod_id = $_POST['bod_id'];
        if(empty($_POST['tipo_proceso']))
            $data['tipo_proceso'] = 1;
        else
            $data['tipo_proceso'] = $_POST['tipo_proceso'];

        $data['articulos'] = $this->bodegas->getArticulosPorBodega($bod_id, $data['tipo_proceso']);

        $this->load->view('/facturacion/articulosBodega',$data);

    }

    function puntos_venta_sucursal()
    {
        $src_id = $_POST['src_id'];

        $puntos = $this->facturacion->getPuntosPorSucursal($src_id);

        $select = '<select name="efa_id_pve" id="efa_id_pve" class="validate[required]">';
        $select .= '<option value="0">Todos los puntos</option>';
        foreach($puntos as $row)
        {
            $select .= '<option value="'.$row->pve_id.'">'.$row->pve_descripcion.'</option>';
        }
        $select .= '</select>';

        echo $select;
    }

    /*CREDITO FISCAL*/
    function credito_fiscal()
    {
        $this->template->set('seccion','Credito Fiscal');
        $this->template->datatables();

        $this->template->toolbar('add','Nuevo credito fiscal','facturacion/facturar/nuevo_credito_fiscal','Nuevo credito fiscal');
        $this->template->toolbar('back','Regresar','#','Regresar');

        $emp_id = getEmpresaId();

        $data['creditos_fiscales'] = $this->facturacion->getCreditosFiscalesEmpresa($emp_id);

        $this->template->load('template','/facturacion/credito_fiscal/index',$data);
    }

    function nuevo_credito_fiscal($ect_id=0)
    {
        $this->template->set('seccion','Credito fiscal - Nuevo');
        $this->template->datatables();

        $this->template->js('js/facturacion/credito_fiscal.js');
        $this->template->js('js/jquery.number.min.js');
        $this->template->formvalidation();
        $script = "
        $('#efa_total').number(true, 2);
        $('.number_format').number(true, 2);
        ";
        $this->template->addScript($script);

        $script = "$('#adminFormFacturaNueva').validationEngine();";
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
        $data['codigo_credito'] = $this->facturacion->correlativoCreditoFiscal($anio, $emp_id, $mod_id);
        $data['sucursales'] = $this->facturacion->getSucursalesUsrEmp($emp_id,$usr_id);
        $data['config'] = $this->configuracion->getConfigEmpresa($emp_id,$mod_id);
        $data['vendedores'] = $this->vendedores->getVendedoresEmpresa($emp_id,$src_id,$pve_id);

        $rutaValidaFecha = 'validaFechaFactura';
        $rutaValidaCodigo = 'validaCodigoFactura';

        /*VERIFICAMOS SI VIENE COTIZACION Y EXISTE PARA LA EMPRESA*/
        if($ect_id > 0)
        {
            $this->load->model('fac_cotizaciones_model', 'cotizaciones');
            $cotiza = $this->cotizaciones->getEncabezadoCotizacion($ect_id);
            if(!empty($cotiza)){
                $this->messages->add('Se esta generando un crédito fiscal apartir de la cotización <strong>'.$cotiza[0]->ect_correlativo.'</strong>', 'alert');
                $data['cotizacion'] = $cotiza;
                $data['articulos_cotizacion'] = $this->cotizaciones->getDetalleCotizacion($ect_id,2);
            }else{
                $this->messages->add('Esta intentando generar una factura apartir de una cotización que no existe.', 'error');
            }

            $rutaValidaFecha = '../validaFechaFactura';
            $rutaValidaCodigo = '../validaCodigoFactura';
        }

        $data['rutaValidaFecha'] = $rutaValidaFecha;
        $data['rutaValidaCodigo'] = $rutaValidaCodigo;

        $this->template->load('template','/facturacion/credito_fiscal/nuevo',$data);
    }

    function inserta_encabezado_credito_fiscal()
    {
        $post = $this->input->post();
        $encabezado = array(
            'ecf_id_usr' => getUsuarioId(),
            'ecf_id_cli' => $post['efa_id_cli'],
            'ecf_id_pef' => $post['efa_id_pef'],
            'ecf_id_pve' => $post['efa_id_pve'],
            'ecf_id_src' => $post['efa_id_src'],
            'ecf_id_vxe' => $post['efa_id_vxe'],
            'ecf_fecha' => date('Y/m/d h:i:s'),
            'ecf_correlativo' => $post['correlativo'],
            'ecf_fecha_documento' => $post['efa_fecha_factura'],
            'ecf_anio' => date('Y', strtotime($post['efa_fecha_factura'])),
            'ecf_mes' => date('m', strtotime($post['efa_fecha_factura'])),
            'ecf_subtotal' => $post['sumas'],
            'ecf_iva' => $post['ecf_iva'],
            'ecf_total' => $post['efa_total'],
        );

        $insert_id = $this->facturacion->insertaEncabezadoCreditoFiscal($encabezado);

        if($insert_id > 0)
        {
            $articulos = $post['articulo'];
            foreach($articulos as $key => $row){
                $art = array(
                    'dcf_id_efa' => $insert_id,
                    'dfa_id_art' => $key,
                    'dfa_cantidad' => $articulos[$key]['cant'],
                    'dfa_precio' => $articulos[$key]['precio'],
                    'dfa_monto' => ($articulos[$key]['cant']) * ($articulos[$key]['precio']),
                    'efa_id_pef' => $post['efa_id_pef'],
                    'efa_codigo_factura' => $post['correlativo'],
                    'efa_fecha_factura' => $post['efa_fecha_factura'],
                    'efa_fecha' => date('Y/m/d h:i:s'),
                    'bod_id' => $articulos[$key]['bodega'],
                );

                $this->facturacion->insertaDetalleCreditoFiscal($art);
            }

            $this->messages->add('Se ha registrado la factura <b>'.$post['correlativo'].'</b> con exito.');
            redirect(site_url('facturacion/facturar/credito_fiscal'),'refresh');
        }else{
            $this->messages->add('Fallo registro de credito fiscal','error');
            redirect(site_url('facturacion/facturar/nuevo_credito_fiscal'),'refresh');
        }

    }

    function detalle_credito_fiscal($ecf_codigo)
    {
        $this->template->set('seccion','Detalle factura');
        $this->template->toolbar('print','Imprimir','#','Imprimir');
        $this->template->toolbar('back','Regresar','#','Regresar');

        $ecf_codigo = setDecode($ecf_codigo);
        $emp_id = getEmpresaId();
        $factura = $this->facturacion->getEncabezadoCreditoFiscal($ecf_codigo);
        if(empty($factura)):
            $this->messages->add('No ha seleccionado una factura valida','error');
            redirect(site_url('facturacion/facturar/factura_comercial'));
        endif;

        $data['factura'] = $factura;
        $data['items_factura'] = $this->facturacion->getDetalleCreditoFiscal($ecf_codigo);
        $data['empresa'] = $this->empresas->getEmpresaById($emp_id);

        $this->template->load('template','/facturacion/credito_fiscal/detalle',$data);
    }

    function json_detalle_credito_fiscal()
    {
        $ecf_id = $this->input->post('ecf_id');
        $encabezado = $this->facturacion->getEncabezadoCreditoFiscal($ecf_id);
        $items = $this->facturacion->getDetalleCreditoFiscal($ecf_id);

        if(!empty($items))
        {
            $arrayToJs['totales'] = ['ecf_subtotal'=>$encabezado[0]->ecf_subtotal, 'ecf_iva'=>$encabezado[0]->ecf_iva, 'ecf_total'=>$encabezado[0]->ecf_total];

            foreach($items as $row)
            {
                $arrayToJs['items'][] = ['dcf_id'=>$row->dcf_id, 'art_codigo_inventario'=>$row->art_codigo_inventario, 'art_descripcion' => $row->art_descripcion, 'dcf_cantidad' => $row->dcf_cantidad, 'unidad'=>0,'dcf_precio'=> setMoneyFormat($row->dcf_precio), 'dcf_monto'=>setMoneyFormat($row->dcf_monto)];
            }
        }else{
            $arrayToJs['totales'] = ['ecf_subtotal'=>0, 'ecf_iva'=>0, 'ecf_total'=>0];
        }

        echo json_encode($arrayToJs);
    }

    function json_creditos_fiscales_cliente()
    {
        $emp_id = getEmpresaId();
        $cli_id = $this->input->post('cliente');
        $creditos_fiscales = $this->facturacion->getCreditosFiscalesPorCliente($emp_id, $cli_id);

        if(!empty($creditos_fiscales))
        {
            $html = '';
            /*foreach($creditos_fiscales as $row)
            {
                $html .= '<tr class="odd trnota" cli_value="'.$row->cli_id.'" cli_label="'.$row->cli_nombre_razon_social.'" value="'.$row->ecf_id.'" label="'.$row->ecf_correlativo.'">';
                $html .= "<td>".$row->ecf_correlativo."</td>";
                $html .= "<td>".$row->ecf_fecha_documento."</td>";
                $html .= "<td>".$row->cli_nombre_razon_social."</td>";
                $html .= "<td>".$row->src_descripcion."</td>";
                $html .= "<td>".$row->ecf_iva."</td>";
                $html .= "<td>".$row->ecf_total."</td>";
                $html .= "</tr>";
            }

            echo $html;*/

            foreach($creditos_fiscales as $row)
            {
                $arrayToJs[] = ['ecf_id'=>$row->ecf_id, 'ecf_correlativo'=>$row->ecf_correlativo, 'ecf_fecha_documento'=>$row->ecf_fecha_documento, 'cli_nombre_razon_social' => $row->cli_nombre_razon_social, 'src_descripcion' => $row->src_descripcion, 'ecf_iva'=>$row->ecf_iva,'ecf_total'=>$row->ecf_total];
            }
        }

        echo json_encode($arrayToJs);
    }

    //FINALIZA CREDITO FISCAL

    //INICIA NOTA DE DEBITO
    function nota_debito()
    {
        $this->template->set('seccion','Notas de débito');
        $this->template->toolbar('add','Nueva nota de débito','facturacion/facturar/nuevo_nota_debito','Nueva nota de débito');
        $this->template->toolbar('back','Regresar','#','Regresar');

        $this->template->load('template','/facturacion/nota_debito/index');
    }
    //FINALIZA NOTA DE DEBITO

    //INICIA NOTA DE CREDITO
    function nota_credito()
    {
        $this->template->set('seccion','Facturación - Notas de credito');
        $this->template->toolbar('add','Nueva nota de credito','facturacion/facturar/nueva_nota_credito','Nueva nota de credito');
        $this->template->toolbar('back','Regresar','#','Regresar');

        $data['notas_credito'] = $this->facturacion->getNotasCreditoEmpresa();

        $this->template->load('template','/facturacion/nota_credito/index', $data);
    }

    function nueva_nota_credito()
    {
        $this->template->formvalidation();
        $this->template->datatables();
        $this->template->js('js/facturacion/nota_credito.js');
        $script = "$('#adminForm').validationEngine();";
        $this->template->addScript($script);
        $this->template->set('seccion','Facturación - nueva nota de credito');
        $this->template->toolbar('back','Regresar','#','Regresar');

        $emp_id = getEmpresaId();
        $mod_id = getModuloId();
        $usr_id = getUsuarioId();
        $anio = getAnioPeriodoFical();
        $src_id = getSucursalId();
        $pve_id = getPuntoVentaId();

        $rutaValidaFecha = 'validaFechaNotaCredito';

        $post = $this->input->post();
        if(!empty($post))
        {
            $valores = array(
                $post['ncr_id_ecf'],
                getUsuarioId(),
                $post['ncr_id_pef'],
                $post['ncr_id_cli'],
                getSucursalId(),
                getPuntoVentaId(),
                $post['correlativo'],
                date('Y/m/d h:i:s'),
                $post['ncr_fecha_documento'],
                $post['ncr_descripcion'],
                $post['ncr_monto'],
                $post['ncr_iva'],
                $post['ncr_total'],
            );
            $insert = $this->facturacion->insertaNotaCredito($valores);
            if($insert)
            {
                if($insert[0]->msg == 0)
                {
                    $msg = 'El credito fiscal no existe.';
                    $type = 'error';
                    $url = 'facturacion/facturar/nueva_nota_credito';
                }elseif($insert[0]->msg == 2)
                {
                    $msg = 'Al credito fiscal seleccionado ya se le han aplicado descuentos.';
                    $type = 'error';
                    $url = 'facturacion/facturar/nueva_nota_credito';
                }elseif($insert[0]->msg == 3)
                {
                    $msg = 'El monto es mayor al del credito fiscal.';
                    $type = 'error';
                    $url = 'facturacion/facturar/nueva_nota_credito';
                }elseif($insert[0]->msg == 1)
                {
                    $msg = 'Se ha aplicado la nota de credtido <strong>'.$post['correlativo'].'</strong> con éxito.';
                    $type = 'error';
                    $url = 'facturacion/facturar/nueva_nota_credito';
                }
            }else{
                $msg = 'Ha ocurrido un problema al insertar el registro.';
                $type = 'error';
                $url = 'facturacion/facturar/nueva_nota_credito';
            }

            $this->messages->add($msg,$type);
            redirect(site_url($url), 'refresh');
        }

        $data['clientes'] = $this->clientes->getClientesByEmpresas($emp_id);
        $data['periodos'] = $this->periodos->getPeriodosFiscales();
        $data['creditos_fiscales'] = $this->facturacion->getCreditosFiscalesEmpresa($emp_id);
        $data['periodo'] = getPeriodoFical();
        $data['pef_id'] = getIdPeriodoFical();
        $data['emp_id'] = $emp_id;
        $data['codigo_nota_credito'] = $this->facturacion->correlativoNotaCredito($anio,$emp_id,$mod_id);
        $data['rutaValidaFecha'] = $rutaValidaFecha;

        $this->template->load('template','/facturacion/nota_credito/nuevo', $data);
    }

    function validaFechaNotaCredito()
    {
        /* RECEIVE VALUE */
        $fechaCliente=$_REQUEST['fieldValue'];
        $validateId=$_REQUEST['fieldId'];
        $per_id=$_REQUEST['ncr_id_pef'];

        $periodo = $this->periodos->getPeriodoById($per_id);

        $arrayToJs = array();
        $arrayToJs[0] = $validateId;

        if(!empty($periodo))
        {
            $periodoMes = $periodo[0]->pef_mes;
            $periodoAnio = $periodo[0]->pef_anio;

            $timestampInicio = mktime(0, 0, 0, $periodoMes, 1, $periodoAnio); //Desde que fecha
            $timestampFin = mktime(0, 0, 0, $periodoMes, 31, $periodoAnio); //Hasta que fecha

            list($anio, $mes, $dia) = explode('/', $fechaCliente);

            $timestampCliente = mktime(0, 0, 0, $mes, $dia, $anio);
            if($timestampCliente >= $timestampInicio && $timestampCliente <= $timestampFin) {
                $arrayToJs[1] = true;			// RETURN TRUE
                echo json_encode($arrayToJs);
            }else{
                $arrayToJs[1] = false;
                echo json_encode($arrayToJs);

            }
        }else{
            $arrayToJs[1] = false;
            echo json_encode($arrayToJs);
        }

    }

    function validaCorrelativoNotaCredito()
    {
        $correlativo=$_REQUEST['fieldValue'];
        $validateId=$_REQUEST['fieldId'];

        $arrayToJs = array();
        $arrayToJs[0] = $validateId;

        $n = $this->facturacion->validaCodigoNotaCreditoPorEmpresa($correlativo);

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
    //FINALIZA NOTA DE CREDITO

    //INICIO DEVOLUCION
    function devolucion()
    {
        $this->template->set('seccion','Facturación - Devolución');
        $this->template->toolbar('add','Nueva devolución','facturacion/facturar/nueva_devolucion','Nueva devolución');
        $this->template->toolbar('back','Regresar','#','Regresar');

        $data['devoluciones'] = $this->facturacion->getDevolucionesEmpresa();

        $this->template->load('template','/facturacion/devolucion/index', $data);
    }

    function nueva_devolucion()
    {
        $this->template->set('seccion','Facturación - Nueva devolución');
        $this->template->toolbar('back','Regresar','#','Regresar');
        $this->template->js('js/facturacion/devolucion.js');
        $script = "$('#adminForm').validationEngine();";

        $emp_id = getEmpresaId();
        $mod_id = getModuloId();
        $usr_id = getUsuarioId();
        $anio = getAnioPeriodoFical();
        $src_id = getSucursalId();
        $pve_id = getPuntoVentaId();

        $post = $this->input->post();
        if(!empty($post))
        {
            $data = array(
                getUsuarioId(),
                $post['efa_id'],
                getIdPeriodoFical(),
                getEmpresaId(),
                date('Y/m/d h:i:s'),
                $post['fad_fecha_documento'],
                utf8_decode($post['fad_descripcion'])
            );

            $insert = $this->facturacion->insertaFacturaDevolucion($data);
            if($insert[0]->msg == 1)
            {
                $this->messages->add('Se ha registrado la devolución de factura <strong>'.$post['efa_correlativo'].'</strong> con éxito.');
                redirect('facturacion/facturar/devolucion', 'refresh');
            }else{
                $this->messages->add('<strong>Error!</strong> Ya se ha registrado una devolución para la factura <strong>'.$post['efa_correlativo'].'</strong>.', 'error');
                redirect('facturacion/facturar/devolucion', 'refresh');
            }

        }
        $data['empresa'] = $this->empresas->getEmpresaById($emp_id);
        $data['clientes'] = $this->clientes->getClientesByEmpresas($emp_id);
        $data['periodos'] = $this->periodos->getPeriodosFiscales();
        $data['periodo'] = getPeriodoFical();
        $data['pef_id'] = getIdPeriodoFical();
        $data['emp_id'] = $emp_id;
        $data['config'] = $this->configuracion->getConfigEmpresa($emp_id,$mod_id);

        $this->template->load('template','/facturacion/devolucion/nueva', $data);
    }
    //FIN DEVOLUCION

    function calcula_iva()
    {
        $art_id = $_GET['art_id'];

        $iva = $this->facturacion->calcularIva($art_id);
        $pregunta = new stdClass();
        $pregunta->precio = $iva[0]->precio;
        $pregunta->iva = $iva[0]->iva;
        $json = json_encode($pregunta);
        echo $json;
    }

    function json_procesa_monto()
    {
        $monto = $this->input->post('monto');

        $array = new stdClass();
        $array->iva = $monto * 0.13;
        $array->total = $array->iva + $monto;

        echo json_encode($array);
    }

    function json_facturas_cliente()
    {
        $cliente = $this->input->post('cliente');
        $emp_id = getEmpresaId();

        $facturas = $this->facturacion->getFacturasClienteEmpresa($emp_id, $cliente);
        if(!empty($facturas))
        {
            foreach($facturas as $row){
                $array[] = ['efa_id'=>$row->efa_id, 'efa_codigo_factura'=>$row->efa_codigo_factura, 'efa_fecha_factura'=>$row->efa_fecha_factura, 'cli_nombre_razon_social'=>$row->cli_nombre_razon_social, 'src_descripcion'=>$row->src_descripcion, 'pve_descripcion'=>$row->pve_descripcion];
            }
        }else{
            $array = false;
        }

        echo json_encode($array);
    }

    function json_detalle_factura()
    {
        $factura = $this->input->post('factura');
        $emp_id = getEmpresaId();

        $array = '';
        $detalle = $this->facturacion->getDetalleFactura($factura);
        $encabezado = $this->facturacion->getEncabezadoFactura($factura);
        if(!empty($detalle))
        {
            $array['encabezado'] = ['src_descripcion'=>$encabezado[0]->src_descripcion, 'pve_descripcion'=>$encabezado[0]->pve_descripcion, 'efa_monto'=>$encabezado[0]->efa_monto];
            foreach($detalle as $row)
            {
                $array['items'][] = ['art_codigo_inventario'=>$row->art_codigo_inventario,'art_descripcion'=>$row->art_descripcion,'dfa_cantidad'=>$row->dfa_cantidad,'unidad'=>'','dfa_precio'=>$row->dfa_precio,'dfa_monto'=>$row->dfa_monto];
            }
        }

        echo json_encode($array);
    }

}