<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/16/14
 * Time: 10:29 AM
 */
class Modulos extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('modulos_model','modulo');
    }

    public function ini()
    {
        $this->template->set('seccion','Gestor de Modulos');

        $this->grocery_crud->set_table('s_mod_modulos');
        $this->grocery_crud->order_by('mod_titulo');
        $this->grocery_crud->set_subject('Modulo');

        $this->grocery_crud->columns('mod_titulo','mod_url','Menu');

        $this->grocery_crud->callback_column('Menu',array($this,'_callback_webpage_url'));

        $this->grocery_crud->display_as('mod_titulo','Titulo');
        $this->grocery_crud->display_as('mod_url','Url');
        $this->grocery_crud->display_as('mod_logo','Logo');

        $this->grocery_crud->required_fields('mod_titulo');
        $this->grocery_crud->required_fields('mod_url');


        //$this->grocery_crud->set_field_upload('mod_url','assets/uploads/modulos');

        $output = $this->grocery_crud->render();

        $this->_grocery_output($output);
    }

    function menu($mod_id = 0)
    {
        $this->template->set('seccion','Gestor de Modulos - Menu');
        $this->template->js('plugins/forms/watermark/jquery.watermark.min.js');
        $this->template->js('plugins/forms/uniform/jquery.uniform.min.js');
        $this->template->js('plugins/forms/select/select2.min.js');
        $this->template->js('plugins/forms/validate/jquery.validate.min.js');
        $this->template->js('js/form-validation.js');


        $data['home'] = 1;
        $data['mod'] = $this->modulo->getModulo($mod_id);
        $data['items_modulo'] = $this->modulo->getItemPorModulo($mod_id);
        $data['mod_id'] = $mod_id;

        $this->template->load('template','modulos/menu',$data);
    }

    function inserta_menu()
    {
        $post = $this->input->post();
        $this->modulo->insertaMenu($post);

        $this->messages->add(SIIE_PROCESS_OK);
        redirect('modulos/menu/'.$post['ixm_id_mod'],'refresh');
    }

    function _grocery_output($output = null)
    {
        $this->template->load('template','modulos/index',$output);
        //$this->load->view('roles/index',$output);
    }

    public function _callback_webpage_url($value, $row)
    {
        return "<a class='btn btn-mini' href='".site_url('modulos/menu/'.$row->mod_id)."'>Configurar</a>";
    }
}