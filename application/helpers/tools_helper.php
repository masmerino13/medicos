<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 5/1/14
 * Time: 10:02 PM
 */

if(!function_exists('setPeriodoModal'))
{
    function setPeriodoModal()
    {
        $CI =& get_instance();
        $CI->load->model('periodos_model','periodo');

        $periodos = $CI->periodo->getPeriodosFiscales();
        if(!empty($periodos))
        {
            $return = base64_encode(current_url());

            echo '<table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th>Año</th>
                        <th>Mes</th>
                        <th width="1%">Predeterminado</th>
                    </tr>
                    </thead>
                    <tbody>';
            foreach($periodos as $row){
                echo '<tr><td>'.$row->pef_anio.'</td><td>'.$row->pef_mes.'</td><td>'.setCheckIcon(site_url('periodo_fiscal/setPeriodoFiscal/'.$row->pef_id.'/'.$return),$row->pef_estado).'</td></tr>';
            }
            echo '</tbody></table>';
        }else{
            echo 'Sin periodos fiscales definidos';
        }
    }
}
    if(!function_exists('setEmpresasModal'))
    {
        function setEmpresasModal(){
            $CI =& get_instance();
            $CI->load->model('empresas_model','empresas');

            $emp_id = getEmpresaId();

            $empresas = $CI->empresas->getEmpresasUsuarioLogin();
            if(!empty($empresas))
            {
                $return = base64_encode(current_url());

                echo '<table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th>Razon social</th>
                        <th>NIT</th>
                        <th>Predeterminada</th>
                    </tr>
                    </thead>
                    <tbody>';
                foreach($empresas as $row){
                    if($emp_id == $row->emp_id)
                        $estado = 1;
                            else
                                $estado = 0;

                    echo '<tr><td>'.$row->emp_razon_social.'</td><td>'.$row->emp_nit.'</td><td>'.setCheckIcon(site_url('empresas/setPredetermianda/'.$row->emp_id.'/'.$return),$estado).'</td></tr>';
                }
                echo '</tbody></table>';
            }else{
                echo 'Sin empresas asignadas';
            }

        }
    }

    if(!function_exists('setModuloActualSesion'))
    {
        function setModuloActualSesion()
        {
            $CI =& get_instance();
            $CI->load->library(array('session'));
            $modulo = $CI->session->userdata('modulo_actual');

            return $modulo;
        }
    }

    if(!function_exists('getModuloId'))
    {
        function getModuloId()
        {
            $CI =& get_instance();
            $CI->load->library(array('session'));
            $modulo = $CI->session->userdata('modulo_actual');

            return $modulo['mod_id'];
        }
    }

    if(!function_exists('getItemId'))
        {
            function getItemId()
            {
                $CI =& get_instance();
                $CI->load->library(array('session'));
                $item = $CI->session->userdata('itemid');

                return $item['menuid'];
            }
        }

    function getPeriodoFical()
    {
        $CI =& get_instance();
        $CI->load->library(array('session'));
        $periodo = $CI->session->userdata('ses_periodo');

        return $periodo['per_mes'].'/'.$periodo['per_anio'];
    }

    function getIdPeriodoFical()
    {
        $CI =& get_instance();
        $CI->load->library(array('session'));
        $periodo = $CI->session->userdata('ses_periodo');

        return $periodo['per_codigo'];
    }

    function getAnioPeriodoFical()
    {
        $CI =& get_instance();
        $CI->load->library(array('session'));
        $periodo = $CI->session->userdata('ses_periodo');

        return $periodo['per_anio'];
    }

    function getEmpresaRazon()
    {
        $CI =& get_instance();
        $CI->load->library(array('session'));
        $sesion = $CI->session->userdata('ses_empresa');

        return substr($sesion['usu_empresa'],0,30);
    }

    function getEmpresaLogo()
    {
        $CI =& get_instance();
        $CI->load->library(array('session'));
        $sesion = $CI->session->userdata('ses_empresa');

        return base_url(). $sesion['usu_emp_logo'];
    }

    function getEmpresaId()
    {
        $CI =& get_instance();
        $CI->load->library(array('session'));
        $sesion = $CI->session->userdata('ses_empresa');

        return $sesion['usu_emp_id'];
    }

    function getUsuarioId()
    {
        $CI =& get_instance();
        $CI->load->library(array('session'));
        $sesion = $CI->session->userdata('logged_in');

        return $sesion['usu_id'];
    }

    function setTipoCliente($tipo)
    {
        switch($tipo)
        {
            case 1:
                return 'Personal Natural';
                break;
            case 2:
                return 'Persona Juridica';
                break;
        }
    }

    function setTipoLocalizacion($tipo)
    {
        switch($tipo)
        {
            case 1:
                return 'Nacional';
                break;
            case 2:
                return 'Extranjera';
                break;
        }
    }

    function setProximoAnios()
    {
        $anio_actual = date('Y');

        $anios = $anio_actual + 5;
        for($a=$anio_actual;$a<=$anios;$a++)
        {
            $numeros[] = $a;
        }

        return $numeros;
    }

    function setMesesDelAnio(){
        $meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio', 'Agosto','Septiembre','Octubre','Noviembre','Diciembre');
        $numeros = array('1','2','3','4','5','6','7', '8','9','10','11','12');

        for($m=0;$m<count($meses);$m++)
        {
            $mes[$numeros[$m]] = $meses[$m];
        }

        return $mes;
    }

    function setDatabaseError($error_number)
    {
        switch($error_number){
            case 1062:
                $msj = 'El registro ya existe en sistema';
                break;
        }

        return $msj;
    }

    if(!function_exists('setCheckIcon'))
    {
        function setCheckIcon($url,$estado)
        {
            if($estado == 1){
                return '<a href="'.$url.'"><i class="icomoon-icon-checkbox"></i></a>';
            }else{
                return '<a href="'.$url.'"><i class="icomoon-icon-checkbox-unchecked"></i></a>';
            }
        }
    }

    if(!function_exists('toString'))
    {
        function toString($dato)
        {
            return "'".$dato."'";
        }
    }

if(!function_exists('setEncode'))
{
    function setEncode($val)
    {
        return base64_encode($val);
    }
}

if(!function_exists('setDecode'))
{
    function setDecode($val)
    {
        return base64_decode($val);
    }
}

if(!function_exists('checkVerificador'))
{
    function checkVerificador($val)
    {
        $val = strtolower($val);
        if($val == 'on')
        {
            return 1;
        }elseif($val == 'off')
        {
            return 0;
        }else
        {
            return 0;
        }
    }
}

if(!function_exists('setMoneyFormat'))
{
    function setMoneyFormat($monto)
    {
        return number_format($monto, 2);
    }
}

if(!function_exists('setLoader'))
{
    function setLoader($class="")
    {
        return '<img src="'.base_url().'assets/images/loaders/circular/072.gif" id="loaderhmvc" class="hide '.$class.'" />';
    }
}

if(!function_exists('isNull'))
{
    function isNull($value="")
    {
        if(empty($value))
        {
            return 0;
        }else{
            return $value;
        }
    }
}

if(!function_exists('setSeparadosByComa'))
{
    function setSeparadosByComa($value)
    {
        if(!empty($value))
        {
            $res = explode(',', $value);
            $html = '<ul>';
            foreach($res as $item)
            {
                $html .= '<li>'.$item.'</li>';
            }
            $html .= '</ul>';
            echo $html;
        }else{
            return 0;
        }
    }
}