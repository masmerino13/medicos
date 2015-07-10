/**
 * Created by Ricardo on 4/6/14.
 */
$(document).ready(function() {
    var base_url = $("#base_url").val();

    /*PUNTOS VENTA POR SUCURSAL*/
    $('#grp_parent').on('change',function(){
        var grupo = $(this).val();

        $.post( base_url+"bodegas/grupos/subgrupos", { grp_id: grupo }, function(data){
            $('#subgrupos_area').html(data);
        });
    });
});
