<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 1/18/2015
 * Time: 2:42 PM
 */
if(!function_exists('med_genera_elemento_html'))
{
    function med_genera_elemento_html($tipo, $name,$id)
    {
        if($tipo == 1)
        {
            return '<input class="span10 left" id="'.$name.'" name="formElement['.$id.']" type="text" />';
        }elseif($tipo == 2)
        {
            return '<textarea class="span10" id="'.$name.'" name="'.$name.'"></textarea>';
        }
    }
}