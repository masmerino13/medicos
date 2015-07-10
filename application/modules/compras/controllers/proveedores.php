<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 12/6/2014
 * Time: 5:35 PM
 */
class Proveedores extends MX_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('cmp_proveedores_model', 'proveedores');
    }

    public function index(){
        $this->template->set('seccion','Lista proveedores');
        $this->template->datatables();
        $this->template->toolbar('add','Nuevo proveedor','compras/proveedores/nuevo','Nuevo proveedor');

        $emp_id = getEmpresaId();

        $data["proveedores"]=$this->proveedores->getProveedoresEmpresa($emp_id);

        $this->template->load('template','compras/proveedores/index', $data);
    }

    public function nuevo(){
        $this->template->set('seccion','Nuevo proveedor');
        $this->template->formvalidation();
        $script = "$('#adminForm').validationEngine();";
        $this->template->addScript($script);

        $post = $this->input->post();
        if(!empty($post)){
            $insertid = $this->proveedores->insertaProveedor($post);
            if($insertid > 0){
                $this->messages->add('Proceso realizado con exito.');
                redirect(site_url('compras/proveedores/detalle/'.$insertid), 'refresh');
            }else{
                $this->messages->add('Fallo en proceso.', 'error');
                redirect(site_url('compras/proveedores'), 'refresh');
            }
        }

        $this->template->load('template','compras/proveedores/nuevo');
    }
}