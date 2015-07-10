<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 5/1/14
 * Time: 9:21 PM
 */
class Periodo_Fiscal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('periodos_model','periodo');
    }

    function ini()
    {
        $this->template->set('seccion','Periodos fiscales');
        $this->template->datatables();
        $this->template->toolbar('add','Nuevo Registro','periodo_fiscal/nuevo','');

        $data['periodos'] = $this->periodo->getPeriodosFiscales();

        $this->template->load('template','periodos/index',$data);
    }

    function nuevo()
    {
        $this->template->set('seccion','Periodos fiscales - Nuevo');

        $data['anios'] = setProximoAnios();
        $data['meses'] = setMesesDelAnio();

        $post = $this->input->post();
        if(!empty($post))
        {
            $this->periodo->insertaPeriodoFiscal($post);
            if($this->db->_error_message())
            {
                $mensaje_error = setDatabaseError($this->db->_error_number());
                $this->messages->add($mensaje_error,'error');
            }else{
                $this->messages->add(SIIE_PROCESS_OK);
                redirect(site_url('periodo_fiscal/ini'));
            }
        }

        $this->template->load('template','periodos/nuevo',$data);
    }

    function modal()
    {
        $this->template->js('js/jquery.dialogextend.js');

        $this->template->load('template','periodos/modal');
    }

    function setPeriodoFiscal($per_id,$return="")
    {
        $return = base64_decode($return);

        $periodo = $this->periodo->getPeriodoById($per_id);

        if(!empty($periodo)){
            if($this->periodo->setPeriodoFavorito($per_id))
            {
                $sess_array = array(
                    'per_codigo' => $periodo[0]->pef_id,
                    'per_mes' => $periodo[0]->pef_mes,
                    'per_anio' => $periodo[0]->pef_anio,
                );

                $this->session->set_userdata('ses_periodo', $sess_array);

                $this->messages->add('Se ha establecido el periodo <strong>Mes: '.$periodo[0]->pef_mes.'</strong> y <strong>Año: '.$periodo[0]->pef_anio.'</strong> como predeterminado.');
            }else{
                $this->messages->add('No se ha podido establecer el periodo.','error');
            }
        }

        redirect($return);
    }
}