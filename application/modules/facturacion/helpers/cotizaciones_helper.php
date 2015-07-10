<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 8/31/14
 * Time: 4:56 PM
 */

if(!function_exists('setEstadoCotizacion'))
{

    function setEstadoCotizacion($estado)
    {
        switch($estado)
        {
            case 0:
                $estado = 'Cancelada';
                break;
            case 1:
                $estado = 'Activa';
                break;
            case 2:
                $estado = 'Facturada';
                break;
        }

        return $estado;
    }
}