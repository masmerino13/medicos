<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 5/18/14
 * Time: 3:19 PM
 */
class Cuentas extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('con_cuentas_model','cuentas');
    }

    function index()
    {
        $this->template->set('seccion','Cuentas contables');
        $this->template->datatables();
        $this->template->formvalidation();
        $script = "$('#adminForm').validationEngine();";
        $this->template->addScript($script);
        $this->template->js('js/contabilidad/catalogo_contable.js');
        $this->template->js('plugins/forms/ibutton/jquery.ibutton.min.js');
        $this->template->css('plugins/forms/ibutton/jquery.ibutton.css');

        $this->template->toolbar('add','Nueva cuenta','facturacion/facturar/nuevo','Nueva factura');

        //$emp_id = getEmpresaId();

        $post = $this->input->post();
        if(!empty($post))
        {
            $post['ccc_detalle'] = checkVerificador($this->input->post('ccc_detalle'));
            if($post['ccc_id'] > 0){
                $this->cuentas->actualizaCuenta($post);
                $this->messages->add('Se ha actualizado la cuenta <strong>'.$post['ccc_cuenta'].' | '.$post['ccc_descripcion'].'</strong>');
            }else{
                $this->cuentas->insertaCuenta($post);
            }
        }

        $cuentas = $this->cuentas->getCuentasParents(0);
        if(empty($cuentas))
            $this->messages->add('No se han registrado cuentas contables en la empresa', 'error');

        $data['cuentas'] = $cuentas;
        $data['tiposCuenta'] = $this->cuentas->tiposCuentas();

        //$data['cuentas'] = $this->cuentas->getCuentasContables();
        //$data['cuentas'] = $this->cuentas;

        $this->template->load('template','contabilidad/cuentas/index',$data);
    }

    function index2()
    {
        $this->template->set('seccion','Cuentas contables');
        $this->template->datatables();
        $js = "
		$( document ).ready( function( ) {
				$( '.tree li' ).each( function() {
						if( $( this ).children( 'ul' ).length > 0 ) {
								$( this ).addClass( 'parent' );
						}
				});

				$( '.tree li.parent > a' ).click( function( ) {
						$( this ).parent().toggleClass( 'active' );
						$( this ).parent().children( 'ul' ).slideToggle( 'fast' );
				});

				$( '#all' ).click( function() {

					$( '.tree li' ).each( function() {
						$( this ).toggleClass( 'active' );
						$( this ).children( 'ul' ).slideToggle( 'fast' );
					});
				});

		});";
        $this->template->addScript($js);
        $this->template->js('js/contabilidad/catalogo_contable.js');

        $this->template->toolbar('add','Nueva cuenta','facturacion/facturar/nuevo','Nueva factura');

        //$emp_id = getEmpresaId();

        $data['cuentas'] = $this->cuentas->getCuentasParents(0);

        $data['cuentas'] = $this->cuentas->getCuentasContables();
        //$data['cuentas'] = $this->cuentas;

        $this->template->load('template','contabilidad/cuentas/index2',$data);
    }

    function json_parents_cuenta()
    {
        $parent_id = $this->input->post('parent');

        $cuentas = $this->cuentas->getCuentasParents($parent_id);

        $arrayToJs='';
        if(!empty($cuentas))
        {
            foreach($cuentas as $row)
            {
                $arrayToJs[] = ['id'=>$row->id, 'desc'=>$row->ccc_descripcion, 'cuenta'=>$row->ccc_cuenta, 'ccc_detalle'=>$row->ccc_detalle, 'n'=>$row->n];
            }
        }

        echo json_encode($arrayToJs);
    }

    function json_detalle_cuenta()
    {
        $cuenta = $this->input->post('cuenta');

        $detalle = $this->cuentas->getDetalleCuenta($cuenta);

        $arrayToJs='';
        if(!empty($detalle))
        {
            $arrayToJs['ccc_id'] = $detalle[0]->ccc_id;
            $arrayToJs['ccc_cuenta'] = $detalle[0]->ccc_cuenta;
            $arrayToJs['ccc_descripcion'] = $detalle[0]->ccc_descripcion;
            $arrayToJs['ccc_tipo_cuenta'] = $detalle[0]->ccc_tipo_cuenta;
            $arrayToJs['ccc_parent'] = $detalle[0]->ccc_parent;
            $arrayToJs['ccc_detalle'] = $detalle[0]->ccc_detalle;
            $arrayToJs['ccc_usa_cc'] = $detalle[0]->ccc_usa_cc;
        }

        echo json_encode($arrayToJs);
    }

    function nuevo()
    {
        $this->template->set('seccion','Facturación - Nueva factura');
        $this->template->datatables();

        $this->template->js('js/factura.js');
        $this->template->formvalidation();
        $this->template->addScript("$('#adminFormFacturaNueva').validationEngine();");


        $emp_id = getEmpresaId();
        $usr_id = getUsuarioId();
        $anio = getAnioPeriodoFical();

        $data['empresa'] = $this->empresas->getEmpresaById($emp_id);
        $data['clientes'] = $this->clientes->getClientesByEmpresas($emp_id);
        $data['periodos'] = $this->periodos->getPeriodosFiscales();
        $data['periodo'] = getPeriodoFical();
        $data['pef_id'] = getIdPeriodoFical();
        $data['emp_id'] = $emp_id;
        $data['bodegas'] = $this->bodegas->getBodegasByEmpresas();
        $data['codigo_factura'] = $this->facturacion->correlativoFactura($anio, $emp_id);
        $data['sucursales'] = $this->facturacion->getSucursalesUsrEmp($emp_id,$usr_id);

        $this->template->load('template','/facturacion/nueva',$data);
    }

    function csv()
    {
        $file = fopen(base_url('assets/csv/cuentas_contables.csv'), 'r');
        //while (($line = fgetcsv($file)) !== FALSE)

        while (($line = fgetcsv($file)) !== FALSE) {
            if($line[4] == 'FALSE')
                $detalle = 0;
            else
                $detalle = 1;

            if($line[7] == 'FALSE')
                $usa = 0;
            else
                $usa = 1;

            $array = array(
                'ccc_id_emp' => 2,
                'ccc_cuenta' => $line[0],
                'ccc_descripcion' => utf8_decode($line[1]),
                'ccc_tipo_cuenta' => $line[2],
                'ccc_parent' => $line[3],
                'ccc_detalle' => $detalle,
                'ccc_usa_cc' => $usa,
            );
            //$this->cuentas->insertaCuenta($array);
            //echo ($line[1]).'<br>';
        }
        fclose($file);
    }
}