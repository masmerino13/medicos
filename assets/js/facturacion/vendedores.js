/**
 * Created by Ricardo on 4/6/14.
 */
$(document).ready(function() {
    var base_url = $("#base_url").val();

    /*PUNTOS VENTA POR SUCURSAL*/
    $('#vxe_id_src').on('change',function(){
        var sucursal = $('#vxe_id_src').val();

        $.post( base_url+"/index.php/facturacion/facturar/puntos_venta_sucursal", { src_id: sucursal }, function(data){
            $('#puntos_sucursal').html(data);
        });
    });

    /*rol*/
    $("#listaPersonal tr").on('click',function(){
        var id = $(this).attr('value');
        var label = $(this).attr('label');

        if(id > 0)
        {
            $("#listaPersonal tr").removeClass('selectedTr')

            $(this).addClass('selectedTr');
            $('#emp_desc').val(label);
            $('#vxe_id_emp').val(id);
        }
    });

    $("#listaPersonal tr").on('dblclick',function(){
        $('#personalModal').dialog('close');
        return false;
    });

    $('#openDialogEmpleados').click(function(){
        $('#personalModal').dialog('open');
        return false;
    });

    $('#personalModal').dialog({
        autoOpen: false,
        modal: true,
        dialogClass: 'dialog',
        buttons: {
            "Close": function() {
                $(this).dialog("close");
            }
        }
    });

    /*$('#dale').click(function(){
        $(this).css('color','red');
    });*/

});
