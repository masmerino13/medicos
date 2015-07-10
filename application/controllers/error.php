<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 4/25/14
 * Time: 11:55 PM
 */
class Error extends Controller {

    function error_404()
    {
        $this->output->set_status_header('404');
        echo "404 - not found";
    }
}