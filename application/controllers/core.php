<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Core extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('modulos_model','modulo');
    }

    function set($mod_id)
    {
        $modulo = $this->modulo->getModulo($mod_id);
		
        $moduloData = array(
            'mod_nombre'  => $modulo[0]->mod_titulo,
            'mod_id'     => $modulo[0]->mod_id,
            'mod_tema' => 'default'
        );

        $this->session->set_userdata('modulo_actual', $moduloData);

        redirect(site_url($modulo[0]->mod_url));
    }

    function itemId($itemid)
    {
        $item = $this->modulo->getItemMenuPorId($itemid);

        $data = array('menuid'=>$item[0]->ixm_id);
        set_cache('itemid',$data);

        redirect(site_url($item[0]->ixm_link));
    }

    function menu()
    {
        $this->load->model('usuario_model','usuario');

        $sesion = $this->session->userdata('logged_in');
        $modulo = $this->session->userdata('modulo_actual');

        $usu_id = $sesion['usu_id'];
        $mod_id = $modulo['mod_id'];

        $accesos = $this->usuario->getAccesosUsuarioPorModulo($usu_id,$mod_id,0,'-');

    }
}