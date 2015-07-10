<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cuentas extends CI_Controller
{
	function __construct()
	{
		parent::__construct();		
	}

	function index()
		{
		$this->template->set('seccion','Cuentas crediticias');

        $columns = array(
            'cue_id_cli'
            ,'cue_numero'
            ,'cue_monto_maximo'
            ,'cue_estado'
            );
        $edit = array(
            'cue_id_cli'
            ,'cue_numero'
            ,'cue_monto_maximo'
            ,'cue_estado'
            );
        $add = array(
            'cue_id_cli'
            ,'cue_numero'
            ,'cue_monto_maximo'
            ,'cue_estado'
            );
        $alias = array(
            'cue_id_cli' => 'Cliente'
            ,'cue_numero' => 'Numero de cuenta'
            ,'cue_monto_maximo' => 'Monto maximo'
            ,'cue_estado' => 'Estado'
            );
        $required = array(
            'cue_id_cli'
            ,'cue_numero'
            ,'cue_monto_maximo'
            );

        $this->grocery_crud->set_table('f_cue_cuenta')
            ->order_by('cue_id')
            ->set_subject('Cuentas')
            ->columns($columns)
            ->edit_fields($edit)
            ->add_fields($add)
            ->display_as($alias)
            ->required_fields($required);

        $this->grocery_crud->set_relation('cue_id_cli','s_cli_cliente','{cli_dui} - {cli_nombre} {cli_apellido}');

        $output = $this->grocery_crud->render();

        $this->_grocery_output($output);
    }

    function _grocery_output($output = null)
    {
        $this->template->load('template','grocery_view',$output);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */