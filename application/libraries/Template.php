<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
		var $template_data = array();
		
		function set($name, $value)
		{
			$this->template_data[$name] = $value;
		}

        function js($jsfile){
            @$this->template_data['js'] .= "\n\t\t<script src='".base_url()."assets/".$jsfile."' type='text/javascript'></script>\n\t";
        }

    function bread($link,$titulo)
    {

    }

    function datatables()
    {
        @$this->template_data['css'] .= "\n\t\t<link href='".base_url()."assets/plugins/tables/dataTables/jquery.dataTables.css' rel='stylesheet' type='text/css' />\n\t";
        @$this->template_data['js'] .= "\n\t\t<script src='".base_url()."assets/plugins/tables/dataTables/jquery.dataTables.min.js' type='text/javascript'></script>\n\t";
        @$this->template_data['js'] .= "\n\t\t<script src='".base_url()."assets/plugins/tables/responsive-tables/responsive-tables.js' type='text/javascript'></script>\n\t";
        @$this->template_data['js'] .= "\n\t\t<script src='".base_url()."assets/js/datatable.js' type='text/javascript'></script>\n\t";
    }

    function formvalidation()
    {
        @$this->template_data['css'] .= "\n\t\t<link href='".base_url()."assets/css/validationEngine.jquery.css' rel='stylesheet' type='text/css' />\n\t";
        @$this->template_data['js'] .= "\n\t\t<script src='".base_url()."assets/js/validation/jquery.validationEngine-es.js' type='text/javascript'></script>\n\t";
        @$this->template_data['js'] .= "\n\t\t<script src='".base_url()."assets/js/validation/jquery.validationEngine.js' type='text/javascript'></script>\n\t";
    }

    function addScript($script,$tipo=0)
    {
        if($tipo == 1)
            $js = "$(document).ready(function(){
            ".$script
             ."});";
        else
            $js = $script;

        @$this->template_data['js'] .= '<script type="text/javascript">'
            .$js
            .'</script>';
    }

    function exitConfirm($msj='')
    {
        if(empty($msj))
        $msj = "'Los datos introducidos se perderan.'";
        else
        $msj = $msj;

        $js = '<script language="JavaScript" type="text/javascript">
                var bPreguntar = true;
                window.onbeforeunload = preguntarAntesDeSalir;
                function preguntarAntesDeSalir()
                {
                  if (bPreguntar)
                    return '.$msj.';
                }
            </script>';

        @$this->template_data['js'] .= $js;
    }

    function css($cssfile)
    {
        $is_external = preg_match("/^https?:\/\//", trim($cssfile)) > 0 ? true : false;

        if(!$is_external){
            @$this->template_data['css'] .= "\n\t\t<link href='".base_url()."assets/".$cssfile."' rel='stylesheet' type='text/css' />\n\t";
        }else{
            @$this->template_data['css'] .= "\n\t\t<link href='".$cssfile."' rel='stylesheet' type='text/css' />\n\t";
        }

    }

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

        $htoolbar = '<div>';

        if(!empty($atributos))
        {
            switch($type){
                case 'add':
                    if($atributos[0]->crea == 1):
                        $htoolbar .= $this->NewBtn($label,$link,$titulo);
                    endif;
                    break;
                case 'edit':
                    if($atributos[0]->edita == 1):
                        $htoolbar .= $this->EditBtn($label,$link,$titulo);
                    endif;
                    break;
                case 'custom':
                    $htoolbar .= $this->CustomBtn($label);
                    break;
                case 'customJs':
                    $htoolbar .= $this->CustomJsBtn($label);
                    break;
                case 'print':
                    $htoolbar .= $this->PrintBtn($label,$link,$titulo);
                    break;
                case 'back':
                    $htoolbar .= $this->BackBtn($label,$link,$titulo);
                    break;
            }
        }


        $htoolbar .= '</div>';

        @$this->template_data['toolbar'] .= $htoolbar;
    }

    function NewBtn($label='',$link='',$titulo='')
    {
        if(empty($titulo))
            $titulo = 'Nuevo Registro';

        $v = '<a class="btn btn-info right marginR10" href="'.site_url($link).'" title="'.$label.'">
                    <span class="icon16 icomoon-icon-file-add white"></span>
                    <strong>'.$titulo.'</strong></a>';

        return $v;
    }

    function EditBtn($label='',$link='',$titulo='')
    {
        if(empty($titulo))
            $titulo = 'Nuevo Registro';

        $v = '<a class="btn btn-info right marginR10" href="'.site_url($link).'" title="'.$label.'">
                    <span class="icon16 icomoon-icon-pencil-2 white"></span>
                    <strong>'.$titulo.'</strong></a>';

        return $v;
    }

    function CustomBtn($params)
    {
        $v = '<a class="btn btn-info right marginR10" href="'.site_url($params['url']).'" title="'.$params['label'].'">
                    <span class="icon16 '.$params['icon'].' white"></span>
                    <strong>'.$params['label'].'</strong></a>';

        return $v;
    }

    function CustomJsBtn($params)
    {
        $v = '<a class="btn btn-info right marginR10" id="'.$params['id'].'" title="'.$params['label'].'">
                    <span class="icon16 '.$params['icon'].' white"></span>
                    <strong>'.$params['label'].'</strong></a>';

        return $v;
    }

    function PrintBtn($label='',$link='',$titulo='')
    {
        if(empty($titulo))
            $titulo = 'Imprimir';

        $v = '<a class="btn btn-primary right marginR10" href="'.site_url($link).'" title="'.$label.'">
                    <span class="icon16 icomoon-icon-printer white"></span>
                    <strong>'.$titulo.'</strong></a>';

        return $v;
    }

    function BackBtn($label='',$link='',$titulo='')
    {
        if(empty($titulo))
            $titulo = 'Regresar';

        $v = '<a onClick="history.go(-1); return false;" class="btn btn-warning right marginR10" href="#" title="'.$label.'">
                    <span class="icon16 icomoon-icon-arrow-left white"></span>
                    <strong>'.$titulo.'</strong></a>';

        return $v;
    }

    function load($template = 'template', $view = '' , $view_data = array(), $return = FALSE)
    {
        $this->CI =& get_instance();
        $this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
        return $this->CI->load->view($template, $this->template_data, $return);
    }
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */