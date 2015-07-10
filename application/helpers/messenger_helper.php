<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/23/14
 * Time: 4:59 PM
 */
if ( ! function_exists('element'))
{
    function messenger($array)
    {
        if(isset($array['message'])){
        for($i=0;$i<count($array['message']);$i++)
        {
            echo $array['message'][$i];
        }
        }

        if(isset($array['error'])){
        for($i=0;$i<count($array['error']);$i++)
        {
            echo $array['error'][$i];

        }
        }

        if(isset($array['alert'])){
        for($i=0;$i<count($array['alert']);$i++)
        {
            echo $array['alert'][$i];

        }
        }
    }
}