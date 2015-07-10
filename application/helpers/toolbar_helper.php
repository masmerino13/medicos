<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/29/14
 * Time: 10:00 PM
 */
if(!function_exists('toolbar'))
{
    function toolbar($type,$label='',$link='',$titulo='')
    {
        $CI =& get_instance();
        $CI->load->library(array('session'));
        $CI->load->model('usuario_model','usuario');
        $CI->load->model('modulos_model','modulo');

        $itemid = $CI->session->userdata('itemid');
        $sesion = $CI->session->userdata('logged_in');

        $rol_id = $sesion['usu_rol_id'];
        $menu_id = $itemid['menuid'];

        $atributos = $CI->usuario->getAtributosUsuario($rol_id,$menu_id);
        $menu = $CI->modulo->getItemMenuPorId($menu_id);

        $htoolbar = '<div class="row-fluid marginB10">';

        switch($type){
            case 'add':
                if($atributos[0]->crea == 1):
                    $htoolbar .= NewBtn($label,$link,$titulo);
                endif;
                break;
        }

        $htoolbar .= '</div>';

        return $htoolbar;
    }

    function NewBtn($label='',$link='',$titulo='')
    {
        if(empty($titulo))
           $titulo = 'Nuevo Registro';

        $v = '<a class="btn btn-primary right" href="'.site_url($link).'" title="'.$label.'">
                    <span class="icon16 icomoon-icon-file-add white"></span>
                    <strong>'.$titulo.'</strong></a>';

        return $v;
    }

    function back()
    {
        echo '<a class="btn btn-danger" href="##" onClick="history.go(-1); return false;"><span class="icon16 icomoon-icon-cancel white"></span> Cancelar</a> ';
    }
}