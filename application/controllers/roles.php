<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/16/14
 * Time: 8:12 AM
 */
session_start();
class Roles extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('roles_model','rol');
    }

    public function ini(){
        $this->template->set('seccion','Gestor de Roles');
        $this->grocery_crud->set_table('s_rol_roles');
        $this->grocery_crud->order_by('rol_titulo');
        $this->grocery_crud->set_subject('Rol');

        $this->grocery_crud->columns('rol_titulo','rol_estado','Permisos');
        $this->grocery_crud->fields('Titulo','Estado');

        $this->grocery_crud->callback_column('Permisos',array($this,'_callback_webpage_url'));

        $this->grocery_crud->display_as('rol_titulo','Titulo');
        $this->grocery_crud->display_as('rol_estado','Estado');

        $output = $this->grocery_crud->render();

        $this->_grocery_output($output);
    }

    function permisos($rol_id = 0)
    {
        $this->template->js('js/elements.js');

        $this->load->model('modulos_model','modulo');

        $this->template->set('seccion','Gestor de Roles - Permisos');

        $data['rol'] = $this->rol->getRol($rol_id);
        $data['modulos'] = $this->modulo->getModulosList();
        $data['modelo'] = $this->modulo;
        $data['rol_model'] = $this->rol;
        $data['rol_id'] = $rol_id;


        $this->template->load('template','roles/permisos',$data);
    }

    function inserta_permisos()
    {
        $post = $this->input->post();

        $permisos = $post['permiso'];
        $accesos = $post['acceso'];

        /*PRIMERO SE ELIMINAN LOS REGISTROS*/
        $this->rol->eliminaAccesosPorRol($post['rol_id']);

        foreach($accesos as $key => $per)
        {
            foreach ($accesos[$key] as $y => $row)
            {
                $data = array(
                    'axr_id_ixm' => $accesos[$key][$y],
                    'axr_id_rol' => $post['rol_id'],
                    'axr_editar' => $permisos[$key]['editar'],
                    'axr_crear' => $permisos[$key]['crear'],
                    'axr_borrar' => $permisos[$key]['elimina'],
                );

                $this->rol->insertaAccesosPorRol($data);
            }
        }

        $this->messages->add(SIIE_PROCESS_OK, "success");

        redirect(site_url('roles/permisos/'.$post['rol_id']), 'redirect');
    }

    function _grocery_output($output = null)
    {
        $this->template->load('template','roles/index',$output);
        //$this->load->view('roles/index',$output);
    }

    public function _callback_webpage_url($value, $row)
    {
        return "<a class='btn btn-mini' href='".site_url('roles/permisos/'.$row->rol_id)."'>Configurar</a>";
    }
}
?>