<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');

        $this->_init();
    }

    private function _init()
    {
        $this->template->css('css/bootstrap/bootstrap.rtl.css');
        $this->template->css('css/bootstrap/bootstrap-responsive.rtl.css');
        $this->template->css('css/supr-theme/jquery.ui.supr.css');
        $this->template->css('css/icons.css');
        $this->template->css('plugins/misc/qtip/jquery.qtip.css');
        $this->template->css('plugins/misc/fullcalendar/fullcalendar.css');
        $this->template->css('plugins/misc/search/tipuesearch.css');
        $this->template->css('plugins/forms/uniform/uniform.default.css');
        $this->template->css('css/main.css');
        $this->template->css('css/custom.css');
        $this->template->css('css/rtl.css');

        $this->template->js('js/bootstrap/bootstrap.js');
        $this->template->js('js/jquery.cookie.js');
        $this->template->js('js/jquery.mousewheel.js');
        /*Charts plugins*/
        $this->template->js('plugins/charts/flot/jquery.flot.js');
        $this->template->js('plugins/charts/flot/jquery.flot.grow.js');
        $this->template->js('plugins/charts/flot/jquery.flot.pie.js');
        $this->template->js('plugins/charts/flot/jquery.flot.resize.js');
        $this->template->js('plugins/charts/flot/jquery.flot.tooltip_0.4.4.js');
        $this->template->js('plugins/charts/flot/jquery.flot.orderBars.js');
        $this->template->js('plugins/charts/sparkline/jquery.sparkline.min.js');
        $this->template->js('plugins/charts/knob/jquery.knob.js');
        /*Misc*/
        $this->template->js('plugins/misc/fullcalendar/fullcalendar.min.js');
        $this->template->js('plugins/misc/qtip/jquery.qtip.min.js');
        $this->template->js('plugins/misc/totop/jquery.ui.totop.min.js');
        /*Search plugin*/
        $this->template->js('plugins/misc/search/tipuesearch_set.js');
        $this->template->js('plugins/misc/search/tipuesearch_data.js');
        $this->template->js('plugins/misc/search/tipuesearch.js');
        /*Forms*/
        $this->template->js('plugins/forms/watermark/jquery.watermark.min.js');
        $this->template->js('plugins/forms/uniform/jquery.uniform.min.js');
        /*Fix*/
        $this->template->js('plugins/fix/ios-fix/ios-orientationchange-fix.js');

        $this->template->js('plugins/fix/touch-punch/jquery.ui.touch-punch.min.js');
        $this->template->js('js/main.js');
        $this->template->js('js/dashboard.js');
    }

	public function index()
	{
        $data['wa'] = 'asdsad';
        $this->template->load('template', 'panel', $data);
		//$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */