/**
 * Created by Ricardo on 4/6/14.
 */

/*INICIA VALIDA MONTO*/
function checkMonto(field, rules, i, options){
    var base_url = $("#base_url").val();
    var ecf_id = $('#ncr_id_ecf').val();
    var ecf_sumas = $('#sumas').attr('value');
    var monto = field.attr('value');

    if (ecf_id > 0) {
        var iva_c, total_c;

        //ESTO DEBERA TOMARSE DESDE BASE DE DATOS
        iva_c = monto * 0.13;
        $('#ncr_iva').val(iva_c.toFixed(2));
        total_c = Number(iva_c) + Number(monto);
        $('#ncr_total').val(total_c.toFixed(2));

        /*if($.trim(monto) > $.trim(ecf_sumas))
        {
            console.log('Noo')
        }else{
            console.log('Bien!')
            //return options.allrules.notaCredito.montoMayor;
        }*/
    }else{
        return options.allrules.notaCredito.sinCreditoFiscal;
    }
}
/*FIN VALIDA MONTO*/

$(document).ready(function() {
    var base_url = $("#base_url").val();

    /*rol*/
    $("#listaPeriodos tr").on('click',function(){
        var id = $(this).attr('value');
        var label = $(this).attr('label');

        if(id > 0)
        {
            $("#listaPeriodos tr").removeClass('selectedTr')

            $(this).addClass('selectedTr');
            $('#periodo').val(label);
            $('#ncr_id_pef').val(id);
        }
    });

    $("#listaPeriodos tr").on('dblclick',function(){
        $('#periodosModal').dialog('close');
        return false;
    });

    $("#listaArticulosFacturaSelected tr.artAdded").live('dblclick',function(){
        $('#articuloModal').dialog('open');
        return false;
    });

    $('#articuloModal').dialog({
        autoOpen: false,
        modal: true,
        dialogClass: 'dialog',
        buttons: {
            "Close": function() {
                $(this).dialog("close");
            }
        }
    });

    /*INICIA CLIENTES MODAL*/
    $('#openDialogClientes').click(function(){
        $('#clientesModal').dialog('open');
        return false;
    });

    $('#clientesModal').dialog({
        autoOpen: false,
        modal: true,
        dialogClass: 'dialog',
        buttons: {
            "Close": function() {
                $(this).dialog("close");
            }
        }
    });

    $("#listaClientes tr").on('click',function(){
        var id = $(this).attr('value');
        var label = $(this).attr('label');

        if(id > 0)
        {
            if(id == $('#ncr_id_cli').val())
            {}else{
                $('#listaArticulosFacturaSelected tbody').html('<tr><td colspan="6">No ha seleccionado ningun credito fiscal.</td></tr>');

                $('#ecf_correlativo').val('');
                $('#ncr_id_ecf').val(0);
                $('#sumas').val(0);
                $('#ecf_iva').val(0);
                $('#efa_total').val(0);
            }

            $("#listaClientes tr").removeClass('selectedTr');

            $(this).addClass('selectedTr')
            $('#cliente').val(label);
            $('#ncr_id_cli').val(id);
        }
    });

    $("#listaClientes tr").on('dblclick',function(){
        $('#clientesModal').dialog('close');
        return false;
    });
    /*FINALIZA CLINTES MODAL*/

    $('#openDialogPeriodos').click(function(){
        $('#periodosModal').dialog('open');
        return false;
    });

    $('#periodosModal').dialog({
        autoOpen: false,
        modal: true,
        dialogClass: 'dialog',
        buttons: {
            "Close": function() {
                $(this).dialog("close");
            }
        }
    });

    /*INICIA CREDITO FISCAL MODAL*/
    $('#openDialogCreditos').on('click', function(){

        var clid_id = $('#ncr_id_cli').val();

        if(clid_id > 0)
        {
            $('#loaderhmvc').show();
            $('#listaCreditosFiscales tbody').html('');

            /*$.post( base_url+'facturacion/facturar/json_creditos_fiscales_cliente', { cliente: clid_id }, function(data){
                $('#listaCreditosFiscales tbody').html(data);
                $('#loaderhmvc').hide();
            });*/

            $.ajax(base_url+'facturacion/facturar/json_creditos_fiscales_cliente', {
                type: 'post',
                dataType: 'json',
                cache: false,
                data: {cliente:clid_id},
                success: function (data) {
                    if (data) {
                        $.each(data, function (index, item) {
                         var eachrow = '<tr class="odd" cli_value="'+clid_id+'" cli_label="'+data[index].cli_nombre_razon_social+'" value="'+data[index].ecf_id+'" label="'+data[index].ecf_correlativo+'">'
                         + "<td>" + data[index].ecf_correlativo + "</td>"
                         + "<td>" + data[index].ecf_fecha_documento + "</td>"
                         + "<td>" + data[index].cli_nombre_razon_social + "</td>"
                         + "<td>" + data[index].src_descripcion + "</td>"
                         + "<td>" + data[index].ecf_iva + "</td>"
                         + "<td>" + data[index].ecf_total + "</td>"
                         + "</tr>";
                         $('#listaCreditosFiscales tbody').append(eachrow);
                         });

                        $('#loaderhmvc').hide();
                    }else{
                        $('#listaCreditosFiscales tbody').html('<tr><td colspan="6">No se encontraron registros.</td></tr>');
                        $('#loaderhmvc').hide();
                    }
                }
            });
        }

        $('#creditosFiscalesModal').dialog('open');
        return false;
    });

    $('#creditosFiscalesModal').dialog({
        autoOpen: false,
        modal: true,
        dialogClass: 'dialog',
        buttons: {
            "Close": function() {
                $(this).dialog("close");
            }
        }
    });

    $("#listaCreditosFiscales tr").live('click',function(){
        var id = $(this).attr('value');
        var label = $(this).attr('label');
        var cli_value = $(this).attr('cli_value');
        var cli_label = $(this).attr('cli_label');

        if(id > 0)
        {
            $('#loaderhmvc').show();
            $('#listaArticulosFacturaSelected tbody').html('');

            $.ajax(base_url+'facturacion/facturar/json_detalle_credito_fiscal', {
                type: 'post',
                dataType: 'json',
                data: {ecf_id:id},
                cache: false,
                success: function (data) {
                    $('#ncr_descripcion').append('Referencia: ' + label);
                    $('#sumas').attr('value',data.totales.ecf_subtotal);
                    $('#ecf_iva').val(data.totales.ecf_iva);
                    $('#efa_total').val(data.totales.ecf_total);

                    if (data.items) {
                        $.each(data.items, function (index, item) {
                            var eachrow = "<tr>"
                                + "<td>" + item.art_codigo_inventario + "</td>"
                                + "<td>" + item.art_descripcion + "</td>"
                                + "<td>" + item.dcf_cantidad + "</td>"
                                + "<td>" + item.unidad + "</td>"
                                + "<td>" + item.dcf_precio + "</td>"
                                + "<td>" + item.dcf_monto + "</td>"
                                + "</tr>";
                            $('#listaArticulosFacturaSelected tbody').append(eachrow);
                        });

                        $('#loaderhmvc').hide();
                    }else{
                        $('#listaArticulosFacturaSelected tbody').html('<tr><td colspan="6">El credito fiscal no posee detalle.</td></tr>');
                        $('#loaderhmvc').hide();
                    }
                }
            });
        }

        $("#listaCreditosFiscales tr").removeClass('selectedTr');

        $(this).addClass('selectedTr')
        $('#ecf_correlativo').val(label);
        $('#ncr_id_ecf').val(id);
        $('#ncr_id_cli').val(cli_value);
        $('#cliente').val(cli_label);
    });

    /*$("#listaCreditosFiscales tr").on('dblclick',function(){
        $('#creditosFiscalesModal').dialog('close');
        return false;
    });*/
/*
    $("#listaCreditosFiscales tbody tr.trnota").live('click',function(){
        alert('EEEEEEEEEEEEEE');
    });*/

    /*FINALIZA CREDITO FISCAL MODAL*/

    if($('#ncr_fecha_documento').length) {
        $("#ncr_fecha_documento").datepicker({
            showOtherMonths:true,
            dateFormat:'yy/mm/dd'
        });
    }

});
