/**
 * Created by Ricardo on 4/6/14.
 */
$(document).ready(function() {
    $("#lista_personal tr").on('click',function(){
        var id = $(this).attr('value');
        var label = $(this).attr('label');

        if(id > 0)
        {
            $("#lista_personal tr").removeClass('selectedTr');

            $(this).addClass('selectedTr')
            $('#usr_persona').val(label);
            $('#per_id').val(id);
        }
    });

    $("#lista_personal tr").on('dblclick',function(){

        $('#modal').dialog('close');
        return false;

    });

    /*rol*/
    $("#lista_roles tr").on('click',function(){
        var id = $(this).attr('value');
        var label = $(this).attr('label');

        if(id > 0)
        {
            $("#lista_roles tr").removeClass('selectedTr')

            $(this).addClass('selectedTr');
            $('#rol').val(label);
            $('#rol_id').val(id);
        }
    });

    $("#lista_roles tr").on('dblclick',function(){
        $('#rolModal').dialog('close');
        return false;
    });


    $('#openDialogRol').click(function(){
        $('#rolModal').dialog('open');
        return false;
    });

    $('#rolModal').dialog({
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
