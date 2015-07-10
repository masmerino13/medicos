<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/28/14
 * Time: 10:24 PM
 */
if(!function_exists('set_cache'))
{
    function set_cache($nombre,$data)
    {
        $CI =& get_instance();
        $CI->load->library(array('session'));

        $CI->session->set_userdata($nombre, $data);

    }
}