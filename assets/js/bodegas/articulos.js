/**
 * Created by Ricardo on 8/12/14.
 */
$(document).ready(function() {
    var base_url = $("#base_url").val();

    $(".ibutton").iButton({
        labelOn: "SI",
        labelOff: "NO",
        enableDrag: false
    });

    $(".treeElement").live('dblclick',function(){
        var id, elemento;

        id = $(this).attr('pid');
        elemento = '#parent_'+id;

        ccc_cuenta = $(this).attr('pid');
        var detalle = $(this).attr('rel');

        $.ajax(base_url+'contabilidad/cuentas/json_detalle_cuenta', {
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {cuenta:ccc_cuenta},
            success: function (data) {
                if (data) {
                    var tipo = $('#tipo').val();

                    if(detalle == 1)
                    {
                        if(tipo == 1)
                        {
                            $('#cuenta_compra').val(data.ccc_cuenta+' | '+data.ccc_descripcion);
                            $('#art_cuenta_compra').val(data.ccc_id);
                        }
                        else if(tipo == 2)
                        {
                            $('#cuenta_venta').val(data.ccc_cuenta+' | '+data.ccc_descripcion);
                            $('#art_cuenta_venta').val(data.ccc_id);
                        }
                        else if(tipo == 3)
                        {
                            $('#cuenta_traslado').val(data.ccc_cuenta+' | '+data.ccc_descripcion);
                            $('#art_cuenta_traslado').val(data.ccc_id);
                        }

                        $('#cuentasModal').dialog('close');
                        return false;
                    }else{
                        $(elemento).append('La cuenta seleccionada no es de detalle.').fadeOut(4000);
                    }
                }else{
                    $(elemento).html('Esta cuenta contable no posee dependencias.').fadeOut(3000);
                }
            }
        });

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

                        var icos, clases;

                        if(data[index].n > 0)
                        {
                            icos = '<i class="icomoon-icon-plus-2"></i>';
                        }
                        else if(data[index].n == 0 & data[index].ccc_detalle == 0 )
                        {
                            icos = '<i class="icon-minus"></i>';
                        }
                        else
                        {
                            icos ='';
                        }

                        detalle = 0;
                        if(data[index].ccc_detalle == 1)
                        {
                            icos = '<i class="minia-icon-list-2 "></i>';
                            detalle = 1;
                        }

                        var eachrow = '<li>'
                            +'<a rel="'+detalle+'" class="treeElement" pid="'+data[index].cuenta+'">'
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

    $("#openDialogCompra").click(function(){
        $('#tipo').val(1);
        $('#cuentasModal').dialog('open');
        return false;
    });

    $("#openDialogCuentaVenta").click(function(){
        $('#tipo').val(2);
        $('#cuentasModal').dialog('open');
        return false;
    });

    $("#openDialogCuentaTraslado").click(function(){
        $('#tipo').val(3);
        $('#cuentasModal').dialog('open');
        return false;
    });

    $('#cuentasModal').dialog({
        autoOpen: false,
        modal: true,
        dialogClass: 'dialog',
        buttons: {
            "Close": function() {
                $(this).dialog("close");
            }
        }
    });

});