<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 4/25/14
 * Time: 11:59 PM
 */
class error404 extends CI_Controller{
    public function __construct()   {
        parent::__construct();
    }
    public function index()
    {
        $this->output->set_status_header('404');
        $data['content'] = 'error_404'; // View name

        $this->template->set('seccion','Ofline');

        $this->template->load('template','404',$data);//loading in my template
    }
}
