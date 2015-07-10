<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 07-10-14
 * Time: 12:07 PM
 */
class Articulos extends MX_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('inv_articulos_model', 'articulos');
        $this->load->model('empresas_model', 'empresas');
    }

    function index(){
        $this->template->set('seccion','Listado articulos');
        $this->template->datatables();
        $this->template->toolbar('add','Nueva articulo','bodegas/articulos/nuevo','Nuevo articulo');

        $emp_id = getEmpresaId();

        $data["articulos"]=$this->articulos->getArticulosEmpresa($emp_id);

        $this->template->load('template','bodegas/articulos/index', $data);

    }

    function nuevo(){
        $this->load->model('inv_grupos_model','grupos');

        $this->template->set('seccion','Articulos - Nuevo Articulo');
        $this->template->formvalidation();
        $script = "$('#adminForm').validationEngine();";
        $this->template->addScript($script);
        $this->template->js('js/bodegas/bodegas.js');
        $this->template->js('plugins/forms/ibutton/jquery.ibutton.min.js');
        $this->template->js('js/bodegas/articulos.js');
        $this->template->css('plugins/forms/ibutton/jquery.ibutton.css');
        $this->template->exitConfirm();
        $this->template->toolbar('back','Regresar','#','Regresar');

        $post=$this->input->post();
        if(!empty($post)){
            $post['art_iva_incluido'] = checkVerificador($this->input->post('art_iva_incluido'));
            $post['art_estado'] = checkVerificador($this->input->post('art_estado'));
            if($this->input->post('art_id') > 0){
                $this->articulos->actualiza_articulo($post);
            }else{
                $result = $this->articulos->inserta_articulos($post);
            }

            if(!empty($result))
            {
                if($result[0]->msg == 0):
                    $this->messages->add('<b>Error!</b> El articulo con codigo '.$post['art_codigo_inventario'].' que intenta registrar  ya existe en esta bodega.','error');
                    redirect(site_url('bodegas/articulos/nuevo'),'refresh');
                    endif;
            }else{
                $this->messages->add(SIIE_PROCESS_OK);
                redirect(site_url('bodegas/articulos'),'refresh');
            }
        }

        $emp_id = getEmpresaId();
        $data['emp_id'] = $emp_id;
        $data['empresa'] = $this->empresas->getEmpresaById($emp_id);
        $data['grupos'] = $this->grupos->getGruposParent();

        $this->template->load('template','bodegas/articulos/nuevo',$data);

    }

    function editar($art_id)
    {
        $articulo = $this->articulos->getDetalleArticulo($art_id);
        if(empty($articulo)):
            $this->messages->add('El articulo seleccionado no existe.','error');
            redirect(site_url('bodegas/articulos'));
            endif;

        $this->load->model('contabilidad/con_cuentas_model','cuentas');
        $this->load->model('inv_grupos_model','grupos');

        $this->template->set('seccion','Articulos - Nuevo Articulo');
        $this->template->js('js/bodegas/articulos.js');
        $this->template->formvalidation();
        $script = "$('#adminForm').validationEngine();";
        $this->template->addScript($script);
        $this->template->js('plugins/forms/ibutton/jquery.ibutton.min.js');
        $this->template->css('plugins/forms/ibutton/jquery.ibutton.css');
        $this->template->toolbar('back','Regresar','#','Regresar');
        //$this->template->exitConfirm();

        $post=$this->input->post();

        $emp_id = getEmpresaId();
        $data['emp_id'] = $emp_id;
        $data['empresa'] = $this->empresas->getEmpresaById($emp_id);
        $data['grupos'] = $this->grupos->getGruposParent();
        $data['articulo'] = $articulo;
        $grp_id = $articulo[0]->art_id_grupo;
        $data['subgrupos'] = $this->grupos->getSubGrupos($grp_id);
        $data['precio_venta'] = 0;
        $data['cuentas'] = $this->cuentas->getCuentasParents(0);

        $this->template->load('template','bodegas/articulos/editar',$data);
    }
}