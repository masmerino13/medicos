/**
 * Created by Ricardo on 4/6/14.
 */
$(document).ready(function() {
    var base_url = $("#base_url").val();

    $("#listaClientes tr").live('click',function(){
        var id = $(this).attr('value');
        var label = $(this).attr('label');

        if(id > 0)
        {
            $("#listaClientes tr").removeClass('selectedTr');

            $(this).addClass('selectedTr')
            $('#cliente').val(label);
            $('#efa_id_cli').val(id);

            var clid_id = $('#efa_id_cli').val();

            if(clid_id > 0)
            {
                $('#listaFacturas tbody').html('');

                if(clid_id === id)
                {
                    $.ajax(base_url+'facturacion/facturar/json_facturas_cliente', {
                        type: 'post',
                        dataType: 'json',
                        cache: false,
                        data: {cliente:clid_id},
                        success: function (data) {
                            if (data) {
                                $.each(data, function (index, item) {
                                    var eachrow = '<tr class="odd" value="'+data[index].efa_id+'" label="'+data[index].efa_codigo_factura+'">'
                                        + "<td>" + data[index].efa_codigo_factura + "</td>"
                                        + "<td>" + data[index].efa_fecha_factura + "</td>"
                                        + "<td>" + data[index].cli_nombre_razon_social + "</td>"
                                        + "<td>" + data[index].src_descripcion + "</td>"
                                        + "<td>" + data[index].pve_descripcion + "</td>"
                                        + "</tr>";
                                    $('#listaFacturas tbody').append(eachrow);
                                });
                            }else{
                                $('#listaFacturas tbody').html('');
                                $('#loaderhmvc').hide();
                                $('#efa_correlativo').val('');
                                $('#efa_id').val('');
                                $('#listaArticulosFacturaSelected tbody').html('<tr><td colspan="6">No se encontraron registros.</td></tr>');
                                $('#sumas').val('');
                                $('#efa_total').val('');
                                $('#src_descripcion').val('');
                                $('#pve_descripcion').val('');
                                $('#fad_descripcion').val('');
                            }
                        }
                    });
                }else{
                    $('#listaFacturas tbody').html('');
                    $('#loaderhmvc').hide();
                    $('#efa_correlativo').val('');
                    $('#efa_id').val('');
                    $('#listaArticulosFacturaSelected tbody').html('<tr><td colspan="6">No se encontraron registros.</td></tr>');
                    $('#sumas').val('');
                    $('#efa_total').val('');
                    $('#src_descripcion').val('');
                    $('#pve_descripcion').val('');
                    $('#fad_descripcion').val('');
                }
            }
        }
    });

    $("#listaClientes tr").on('dblclick',function(){
        $('#clientesModal').dialog('close');
        return false;
    });

    /*MODAL DE FACTURAS*/
    $('#openDialogFactura').click(function(){
        $('#facturasModal').dialog('open');
        return false;
    });

    $('#facturasModal').dialog({
        autoOpen: false,
        modal: true,
        dialogClass: 'dialog',
        buttons: {
            "Close": function() {
                $(this).dialog("close");
            }
        }
    });

    $("#listaFacturas tr").live('click',function(){
        var id = $(this).attr('value');
        var label = $(this).attr('label');

        if(id > 0)
        {
            $("#listaFacturas tr").removeClass('selectedTr');

            $(this).addClass('selectedTr')
            $('#efa_correlativo').val(label);
            $('#fad_descripcion').val('Devolución factura: '+label);
            $('#efa_id').val(id);

            $.ajax(base_url+'facturacion/facturar/json_detalle_factura', {
                type: 'post',
                dataType: 'json',
                cache: false,
                data: {factura:id},
                success: function (data) {
                    if (data) {
                        $('#listaArticulosFacturaSelected tbody').html('');
                        $.each(data.items, function (index, item) {
                            var eachrow = '<tr>'
                                + "<td>" + item.art_codigo_inventario + "</td>"
                                + "<td>" + item.art_descripcion + "</td>"
                                + "<td>" + item.dfa_cantidad + "</td>"
                                + "<td>" + item.unidad + "</td>"
                                + "<td>" + item.dfa_precio + "</td>"
                                + "<td>" + item.dfa_monto + "</td>"
                                + "</tr>";
                            $('#listaArticulosFacturaSelected tbody').append(eachrow);
                        });

                        $('#sumas').val(data.encabezado.efa_monto);
                        $('#efa_total').val(data.encabezado.efa_monto);
                        $('#src_descripcion').val(data.encabezado.src_descripcion);
                        $('#pve_descripcion').val(data.encabezado.pve_descripcion);
                    }else{
                        $('#listaArticulosFacturaSelected tbody').html('<tr><td colspan="6">No se encontraron registros.</td></tr>');
                        $('#loaderhmvc').hide();
                    }
                }
            });
        }
    });
    /*FIN MODAL FACTURAS*/

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

    if($('#fad_fecha_documento').length) {
        $("#fad_fecha_documento").datepicker({
            showOtherMonths:true,
            dateFormat:'yy/mm/dd'
        });
    }
});
