<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Grocery extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->library('grocery_CRUD');
    }

    function index()
    {
        $this->template->set('seccion','Gestor de Empresas');

        $crud = new grocery_CRUD();
        $crud->set_table('s_emp_empresas');
        //$crud->columns('customerName','phone','addressLine1','creditLimit');

        $output = $crud->render();

        $this->_example_output($output);
    }

    function _example_output($output = null)
    {
        $this->template->load('template','vgrocery',$output);
        //$this->load->view('vgrocery',$output);
    }
}