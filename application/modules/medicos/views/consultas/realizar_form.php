<?php
echo form_open(site_url('medicos/consultas/realizar/'.$pac_key.'/'.$form_id));
if(!empty($grupos))
{
    $html = '';
    foreach($grupos as $grupo)
    {
        $html .= '<fieldset>';
            $html .= '<legend>'.$grupo->exf_label.'</legend>';
            $html .= '<div class="row-fluid">';
                    $elementos = $model->getElelentoFormularioPorGrupo($grupo->exf_id);
                    if(!empty($elementos))
                    {
                        $row = 1;
                        foreach($elementos as $elemento)
                        {
                            $html .= '<div class="span4" style="margin: 0;border-bottom: 1px dashed lightgray">
                        <div class="form-field-box even">
                            <div class="row-fluid">
                                <label class="form-label span12 text-left" style="text-align: left" for="fxc_titulo">'.$elemento->exf_label.'</label>';
                                $html .= med_genera_elemento_html($elemento->exf_tipo, $elemento->exf_name, $elemento->exf_id);
                            $html .= '</div>
                        </div>';
                        $html .= '</div>';
                            $row = $row + 1;


                        }
                    }
            $html .= '</div>';
        $html .= '</fieldset>';
    }

    echo $html;
}
?>
<div class="clear"></div>
<div class="pDiv marginT10 text-right">
    <p>
        <?= form_button(array('content'=>'<span class="icon16 icomoon-icon-checkmark white "></span>Guardar datos','class'=>'btn btn-success','type'=>'submit'))?>
    </p>

</div>
<input type="hidden" name="paciente_code" value="<?= $paciente[0]->pac_id?>">
<?php
echo form_close();
?>