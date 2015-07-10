/**
 * Created by Ricardo on 9/14/14.
 */
$(document).ready(function() {
    $(".ibutton").iButton({
        labelOn: "SI",
        labelOff: "NO",
        enableDrag: false
    });

    var base_url = $('#base_url').val();

    $(".treeElement").live('dblclick',function(){
        ccc_cuenta = $(this).attr('pid');

        $.ajax(base_url+'contabilidad/cuentas/json_detalle_cuenta', {
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {cuenta:ccc_cuenta},
            success: function (data) {
                if (data) {
                    $('#ccc_cuenta').val(data.ccc_cuenta);
                    $('#ccc_descripcion').val(data.ccc_descripcion);
                    $('#ccc_parent').val(data.ccc_parent);
                    $('#ccc_id').val(data.ccc_id);

                    if(data.ccc_detalle > 0)
                    {
                        $("#ccc_detalle").iButton("toggle", true);
                        $('#ccc_detalle').prop('checked',true);
                    }else{
                        $('#ccc_detalle').prop('checked',false)
                        $("#ccc_detalle").iButton("toggle", false);
                    }

                    $('#ccc_tipo_cuenta option').each(function (){
                        if(data.ccc_tipo_cuenta === $(this).attr('value'))
                        {
                            $(this).attr('selected','selected')
                        }
                    });

                }else{
                    $(elemento).html('Esta cuenta contable no posee dependencias.').fadeOut(3000);
                }
            }
        });

        $('#editarCuentaModal').dialog('open');
        return false;
    });

    $('#editarCuentaModal').dialog({
        autoOpen: false,
        modal: true,
        dialogClass: 'dialog',
        buttons: {
            "Close": function() {
                $(this).dialog("close");
            }
        }
    });


    $('.treeElement').live('click',function(){
        var id, elemento;

        id = $(this).attr('pid');
        elemento = '#parent_'+id;
        $(elemento).html('Cargando...');

        $.ajax(base_url+'contabilidad/cuentas/json_parents_cuenta', {
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {parent:id},
            success: function (data) {
                if (data) {
                    $(elemento).html('');
                    $.each(data, function (index, item) {

                        var icos;

                        if(data[index].n > 0)
                            icos = '<i class="icomoon-icon-plus-2"></i>';
                        else if(data[index].n == 0 & data[index].ccc_detalle == 0 )
                            icos = '<i class="icon-minus"></i>';
                        else
                            icos ='';

                        if(data[index].ccc_detalle == 1)
                            icos = '<i class="minia-icon-list-2 "></i>';

                        var eachrow = '<li>'
                            +'<a class="treeElement" pid="'+data[index].cuenta+'">'
                            +icos+' '+data[index].cuenta+ ' | '+data[index].desc
                            +'</a>'
                            + '<ul id="parent_'+data[index].cuenta+'"></ul>'
                            +'</li>';
                        $(elemento).append(eachrow);
                    });
                }else{
                    $(elemento).html('Esta cuenta contable no posee dependencias.').fadeOut(3000);
                }
            }
        });

    });
});
