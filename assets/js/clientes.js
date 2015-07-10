/**
 * Created by Ricardo on 5/4/14.
 */
/**
 * Created by Ricardo on 4/6/14.
 */
$(document).ready(function() {
    var base_url = $("#base_url").val();
    $("#addMails").on('click',function(){
        $('#correosArea').append('<input class="span12" name="correo[]" type="text" />');
    });

    $("#addWebs").on('click',function(){
        $('#websArea').append('<input class="span12" name="web[]" type="text" />');
    });

    $("#addTel").on('click',function(){
        $('#telsArea').append('<input class="span2 left" name="area[]" type="text" /><input class="span10 left" name="telefono[]" type="text" />');
    });

    $("#addFax").on('click',function(){
        $('#faxArea').append('<input class="span2 left" name="farea[]" type="text" /><input class="span10 left" name="fax[]" type="text" />');
    });

    $('#depto').on('change',function(){
        var dep = $(this).val();
        $('#muni').html('<img src="../../../../assets/images/loaders/horizontal/063.gif"> ');
        $.post( base_url+"/misc/municipios", { depto: dep })
            .done(function( data ) {
                $('#muni').html(data);
            });
    });
});
