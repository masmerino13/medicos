/**
 * Created by Ricardo on 4/6/14.
 */
$(document).ready(function() {
        var base_url = $("#base_url").val();

    $('#efa_id_src').on('change',function(){
        var sucursal = $('#efa_id_src').val();

        $.post( base_url+"/index.php/facturacion/facturar/puntos_venta_sucursal", { src_id: sucursal }, function(data){
            $('#puntos_sucursal').html(data);
        });
    });

    $("#listaClientes tr").on('click',function(){
        var id = $(this).attr('value');
        var label = $(this).attr('label');

        if(id > 0)
        {
            $("#listaClientes tr").removeClass('selectedTr');

            $(this).addClass('selectedTr')
            $('#cliente').val(label);
            $('#efa_id_cli').val(id);
        }
    });

    $("#listaClientes tr").on('dblclick',function(){
        $('#clientesModal').dialog('close');
        return false;
    });

    /*MODAL DE VENDEDORES*/
    $('#openDialogVendedores').click(function(){
        $('#vendedoresModal').dialog('open');
        return false;
    });

    $('#vendedoresModal').dialog({
        autoOpen: false,
        modal: true,
        dialogClass: 'dialog',
        buttons: {
            "Close": function() {
                $(this).dialog("close");
            }
        }
    });

    $("#listaVendedores tr").on('click',function(){
        var id = $(this).attr('value');
        var label = $(this).attr('label');

        if(id > 0)
        {
            $("#listaVendedores tr").removeClass('selectedTr');

            $(this).addClass('selectedTr')
            $('#vxe_desc').val(label);
            $('#efa_id_vxe').val(id);
        }
    });

    $("#listaVendedores tr").on('dblclick',function(){
        $('#vendedoresModal').dialog('close');
        return false;
    });

    /*BODEGAS*/
    $("#listaBodegas tr").on('click',function(){
        var id = $(this).attr('value');
        var label = $(this).attr('label');

        if(id > 0)
        {
            $("#listaBodegas tr").removeClass('selectedTr');

            $(this).addClass('selectedTr')
            $('#bodega').val(label);
            $('#bod_id').val(id);
        }
    });

    $("#listaBodegas tr").on('dblclick',function(){
        $('#bodegasModal').dialog('close');
        return false;
    });

    /*rol*/
    $("#listaPeriodos tr").on('click',function(){
        var id = $(this).attr('value');
        var label = $(this).attr('label');

        if(id > 0)
        {
            $("#listaPeriodos tr").removeClass('selectedTr')

            $(this).addClass('selectedTr');
            $('#periodo').val(label);
            $('#efa_id_pef').val(id);
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

    $('#openDialogBodegas').click(function(){
        $('#bodegasModal').dialog('open');
        return false;
    });

    $('#bodegasModal').dialog({
        autoOpen: false,
        modal: true,
        dialogClass: 'dialog',
        buttons: {
            "Close": function() {
                $(this).dialog("close");
            }
        }
    });

    $('#getArticulosBodega').on('click',function(){
        $('#articulosModal').dialog('open');

        $('#listadoArticulos').html('');

        var bodega = $('#bod_id').val();
        $('#listadoArticulos').html('<img src="../../../assets/images/loaders/horizontal/063.gif"> ');

        $.post( base_url+"/facturacion/facturar/articulos_bodega", { bod_id: bodega }, function(data){
            $('#listadoArticulos').html(data);
        });
    });

    $('#articulosModal').dialog({
        autoOpen: false,
        modal: true,
        dialogClass: 'dialog',
        title:'Articulos en bodega',
        height:650,
        buttons: {
            "Close": function() {
                $(this).dialog("close");
            }
        }
    });

});
