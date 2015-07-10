<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/23/14
 * Time: 9:33 PM
 */
class Personas extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->load->model('personas_model','personas');
    }

    function ini()
    {
        $this->template->set('seccion','Gestor de Personal');

        $this->grocery_crud->set_table('s_per_personas');
        $this->grocery_crud->order_by('per_primer_apellido');
        $this->grocery_crud->set_subject('Personal');

        $this->grocery_crud->columns('per_primer_nombre','per_segundo_nombre','per_primer_apellido','per_segundo_apellido','per_dui');

        $this->grocery_crud->display_as('per_primer_nombre','Primer Nombre');
        $this->grocery_crud->display_as('per_segundo_nombre','Segundo Nombre');
        $this->grocery_crud->display_as('per_primer_apellido','Primer Apellido');
        $this->grocery_crud->display_as('per_segundo_apellido','Segundo Apellido');
        $this->grocery_crud->display_as('per_dui','DUI');
        $this->grocery_crud->display_as('per_nit','NIT');
        $this->grocery_crud->display_as('per_fecha_nacimiento','Fecha Nacimiento');
        $this->grocery_crud->display_as('per_fecha_ingreso','Fecha Registro');
        $this->grocery_crud->display_as('per_estado','Estado');

        $this->grocery_crud->required_fields('per_primer_nombre','per_primer_apellido','per_dui','per_nit');

/*
        $this->grocery_crud->display_as('mod_titulo','Titulo');
        $this->grocery_crud->display_as('mod_url','Url');
        $this->grocery_crud->display_as('mod_logo','Logo');

        $this->grocery_crud->required_fields('mod_titulo');
        $this->grocery_crud->required_fields('mod_url');
*/

        //$this->grocery_crud->set_field_upload('mod_url','assets/uploads/modulos');

        $output = $this->grocery_crud->render();

        $this->_grocery_output($output);
    }

    function _grocery_output($output = null)
    {
        $this->template->load('template','personas/index',$output);
        //$this->load->view('roles/index',$output);
    }
}