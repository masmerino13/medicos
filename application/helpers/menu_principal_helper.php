<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/28/14
 * Time: 10:28 PM
 */

if(!function_exists('menu_principal'))
{
    function menu_principal()
    {
        $CI =& get_instance();
        $CI->load->library(array('session'));
        $CI->load->model('usuario_model','usuario');

        $sesion = $CI->session->userdata('logged_in');
        $modulo = $CI->session->userdata('modulo_actual');

        $usu_id = $sesion['usu_id'];
        $mod_id = $modulo['mod_id'];

        $modulos = $CI->usuario->getModulosPorUsuario($usu_id);

        $menu = '<div class="navbar">
                <div class="navbar-inner">
                        <div class="nav-no-collapse">
                            <ul class="nav" style="margin: 15px 0">
                                <li class="dropdown" style="margin-right: 0px">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="icon16 icomoon-icon-grid-view"></span>Modulos de Sistema
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="menu">
                                            <ul class="messages">
                                                <li class="header">Aplicaciones de acceso al usuario</li>';
                                                foreach($modulos as $row):
                                                $menu .= '<li>
                                                    <a href="'.site_url('core/set/'.$row->mod_id).'">
                                                        <span class="icon16 '.$row->mod_logo.'"></span>
                                                        <strong>'.$row->mod_titulo.'</strong>
                                                    </a>
                                                </li>';
                                                endforeach;

                                            $menu .= '</ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div><!-- /.nav-collapse -->
                </div><!-- /navbar-inner -->
            </div>';

       $menu .= '<div class="sidenav">

                <div class="sidebar-widget" style="margin: -1px 0 0 0;">
                    <h5 class="title" style="margin-bottom:0">'.$modulo['mod_nombre'].'</h5>
                </div>';

       $menu .=  '<div class="mainnav">';
        echo $menu;
        $CI->usuario->getAccesosUsuarioPorModulo($usu_id,$mod_id,0,' ','','',1);
        echo '</div></div>';


        //genera_menu($usu_id,0,0);
    }

    function genera_menu($user_id, $item_id, $parent=0)
    {
        $CI =& get_instance();
        $CI->load->database();

        $html = '<ul>';

        $CI->database->select('*');
        $CI->database->from('s_mod_modulos');
        $CI->database->where($this->id, $emp_id);

        $query = $this -> db -> get();

        if($query -> num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
}