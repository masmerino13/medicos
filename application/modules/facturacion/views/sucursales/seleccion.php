<div class="row-fluid">

    <div class="span12">
        <div class="box gradient">

            <div class="title">
                <h4>
                    <span>Puntos de venta por sucursal</span>
                </h4>
            </div>
            <?php
            if(!empty($sucursales)){
                $pve_id = getPuntoVentaId();
            ?>
            <div class="accordion pattern" id="accordion3">
                <?php
                $items = '';
                foreach($sucursales as $row)
                {
                    $items .= '<div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#acoor'.$row->src_id.'">
                                    '.$row->src_descripcion.'
                                </a>
                            </div>
                            <div id="acoor'.$row->src_id.'" class="accordion-body collapse" style="height: 0px; ">
                                <div class="accordion-inner">';
                    $puntos = $modelo->getPuntosPorSucursal($row->src_id);
                    if(count($puntos[0]) > 0)
                    {
                        $tabla = '<table class="responsive dynamicTable display table table-bordered"><thead><tr><th>Punto</th><th>Predeterminado</th></tr></thead>';
                       foreach($puntos as $pve)
                       {
                           if($pve_id == $pve->pve_id)
                               $estado = 1;
                           else
                               $estado = 0;

                           $tabla .= '<tr><td>'.$pve->pve_descripcion.'</td>';
                           $tabla .= '<td>'.setCheckIcon(site_url('facturacion/sucursales/setPuntoVenta/'.$pve->pve_id),$estado).'</td></tr>';
                       }
                        $tabla .= '</table>';

                        $items .= $tabla;
                    }else{
                        $items .= '<small>Esta sucursal no posee puntos de venta.';
                    }


                    $items .= '</div>
                            </div>
                        </div>';


                }
                echo $items;
                ?>

            </div>
            <?php }else{
                $this->messages->add('Su usuario no posee sucursales.','error');
            } ?>
        </div>
    </div>
</div>