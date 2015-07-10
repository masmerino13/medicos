<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 7/9/14
 * Time: 8:19 PM
 */
class Bodegas extends MX_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('inv_bodegas_model','bodegas');
    }

    function index(){
        $this->template->set('seccion','Listado bodegas');
        $this->template->toolbar('add','Nueva bodega','bodegas/bodegas/nuevo','Nueva bodega');

        $var["bodegas"]=$this->bodegas->getBodegasByEmpresas();
        $this->template->load('template','/bodegas/index',$var);
    }

    function nuevo(){

        $this->template->set('seccion','Bodega - Nueva Bodega');
        $this->template->load('template','/bodegas/nuevo');

        $post = $this->input->post();

        if(!empty($post)){

            $datos = array(
                'bod_id_emp' => getEmpresaId(),
                'bod_descripcion' => $post['bod_descripcion'],
                'bod_estado' => $post['bod_estado'],
            );
            if ($this->bodegas->inserta_bodega($datos)){
                $this->messages->add(SIIE_PROCESS_OK);
                redirect(site_url('bodegas/bodegas'),'refresh');

            }
        }
    }

    function articulos($bod_id)
    {
        $this->template->set('seccion','Articulos en bodega');
        $this->template->datatables();

        $this->template->toolbar('add','Agregar articulo','bodegas/bodegas/nuevo_articulo/'.$bod_id,'Agregar articulo');

        $emp_id = getEmpresaId();
        $data['articulos'] = $this->bodegas->getArticulosPorBodega($bod_id);

        $this->template->load('template','/bodegas/articulos',$data);
    }

    function nuevo_articulo($bod_id)
    {
        $this->template->set('seccion','Agregar articulo a bodega');
        $this->template->js('js/bodegas.js');
        $this->template->formvalidation();
        $script = "$('#admiForm').validationEngine();";
        $this->template->addScript($script);

        $bodega = $this->bodegas->getBodegaById($bod_id);
        $data['bod_id'] = $bod_id;
        if(empty($bodega))
        {
            $this->messages->add('<b>Error!</b> La bodega no existe.','error');
            redirect(site_url('bodegas/bodegas/articulos/'.$bod_id));
        }
        $data['bodega'] = $bodega;
        $emp_id = getEmpresaId();
        $data['articulos'] = $this->bodegas->getArticulosPorEmpresa($emp_id);

        $post = $this->input->post();
        if(!empty($post))
        {
            $insert = $this->bodegas->insertaArticuloPorBodega($post);
            if(!empty($insert))
                $mensaje = $insert[0]->msg;
            else
                $mensaje = 2;

            if($mensaje == 1):
                $this->messages->add('<b>Aviso!</b> El articulo <b>'.$post['art_desc'].'</b> ya ha sido asignado a esta bodega','alert');
                redirect(site_url('bodegas/bodegas/nuevo_articulo/'.$bod_id),'refresh');
            elseif($mensaje == 0):
                $this->messages->add('<b>Error!</b> El articulo que intenta agregar no existe.','error');
                redirect(site_url('bodegas/bodegas/nuevo_articulo/'.$bod_id),'refresh');
            else:
                $this->messages->add('Se a agregado el articulo <b>'.$post['art_desc'].'</b> a la bodega.');
                redirect(site_url('bodegas/bodegas/articulos/'.$bod_id),'refresh');
            endif;
        }

        $this->template->load('template','/bodegas/nuevo_articulo',$data);
    }
}