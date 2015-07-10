/**
 * Created by Ricardo on 7/9/14.
 */
$('#openDialogArticulos').click(function(){
    $('#articulosModal').dialog('open');
    return false;
});

$('#articulosModal').dialog({
    autoOpen: false,
    modal: true,
    dialogClass: 'dialog',
    buttons: {
        "Close": function() {
            $(this).dialog("close");
        }
    }
});

$("#listaArticulos tr").on('click',function(){
    var id = $(this).attr('value');
    var label = $(this).attr('label');

    if(id > 0)
    {
        $("#listaArticulos tr").removeClass('selectedTr');

        $(this).addClass('selectedTr')
        $('#art_desc').val(label);
        $('#art_id').val(id);
    }
});

$("#listaArticulos tr").on('dblclick',function(){
    $('#articulosModal').dialog('close');
    return false;
});
