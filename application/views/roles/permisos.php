<div class="span12">

    <div class="box">

        <div class="title">
            <h4>
                <span class="icon16 icomoon-icon-equalizer-2"></span>
                <span>Permisos de Acceso Rol</span>
            </h4>
        </div>
        <div class="content">
            <?php
            $attributes = array('id' => 'form-validate');
            echo form_open(site_url('roles/inserta_permisos'),$attributes)
            ?>

            <div class="form-row row-fluid">
                <div class="span12">
                    <div class="row-fluid">
                        <label class="form-label span3" for="ixm_titulo">Rol</label>
                        <input class="span9" readonly value="<?= $rol[0]->rol_titulo ?>" id="ixm_titulo" name="ixm_titulo" type="text" />
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <div class="page-header">
                        <h4>Asignar accesos</h4>
                    </div>
                    <div class="accordion pattern" id="accordion3">
                        <?php
                        $items = '';
                        foreach($modulos as $row)
                        {
                            $items .= '<div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#acoor'.$row->mod_id.'">
                                    '.$row->mod_titulo.'
                                </a>
                            </div>
                            <div id="acoor'.$row->mod_id.'" class="accordion-body collapse" style="height: 0px; ">
                                <div class="accordion-inner">';
                                    $per = $modelo->getItemPorModulo($row->mod_id);
                                    if(count($per[0]) > 0)
                                    {
                                        $permisos = $rol_model->getValidaPermisosModuloPorRol($rol_id,$row->mod_id);

                                        @$items .= '<table style="width:50%"><tr><td>'.form_checkbox(array('name'=>'permiso['.$row->mod_id.'][crear]','id'=>'crear_'.$row->mod_id,'value'=>'1','checked'=>$permisos[0]->crear)). form_label('Crear','crear_'.$row->mod_id) .'</td><td>'.form_checkbox(array('name'=>'permiso['.$row->mod_id.'][editar]','value'=>'1','checked'=>$permisos[0]->editar)) . form_label('Editar','editar_'.$row->mod_id).'</td><td>'.form_checkbox(array('name'=>'permiso['.$row->mod_id.'][elimina]','value'=>'1','checked'=>$permisos[0]->borrar)) . form_label('Eliminar','elimina_'.$row->mod_id).'</td></tr></table><hr>';
                                        $tabla = '<table>';
                                        foreach($per as $item)
                                        {
                                            $valida = $rol_model->getValidaItemModuloPorRol($rol_id, $item->ixm_id);

                                            if($valida[0]->n > 0)
                                            {
                                                $tabla .= '<tr><td>'.form_checkbox(array('name'=>'acceso['.$row->mod_id.'][]','value'=>$item->ixm_id,'id'=> 'item_'.$item->ixm_id, 'checked'=>true)).'</td><td>'. form_label($item->ixm_titulo,'item_'.$item->ixm_id).'</td></tr>';
                                            }else{
                                                $tabla .= '<tr><td>'.form_checkbox(array('name'=>'acceso['.$row->mod_id.'][]','value'=>$item->ixm_id,'id'=> 'item_'.$item->ixm_id, 'checked'=>false)).'</td><td>'. form_label($item->ixm_titulo,'item_'.$item->ixm_id).'</td></tr>';
                                            }

                                        }
                                        $tabla .= '</table>';

                                        $items .= $tabla;
                                    }else{
                                        $items .= '<small>Este modulo no posee items de menu, <a href="'.site_url('modulos/menu/'.$row->mod_id).'">agregar items de menu</a></small>';
                                    }
                                $items .= '</div>
                            </div>
                        </div>';


                        }
                        echo $items;
                        ?>

                    </div>
                </div>
            </div>

            <div class="form-row row-fluid">
                <div class="span12">
                    <div class="row-fluid">
                        <div class="form-actions">
                            <div class="span3"></div>
                            <div class="span9 controls">
                                <?= form_button(array('content'=>'<span class="icon16 icomoon-icon-checkmark white"></span>'.SIIE_BTN_SAVE,'class'=>'btn btn-success','type'=>'submit'))?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            echo form_hidden('rol_id',$rol_id);
            echo form_close();
            ?>

        </div>

    </div><!-- End .box -->

</div>