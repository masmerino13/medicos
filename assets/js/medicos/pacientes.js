/**
 * Created by Ricardo on 12/3/2014.
 */
$(document).ready(function() {
    var base_url = $("#base_url").val();

    if($('.campo_fecha').length) {
        $(".campo_fecha").datepicker({
            showOtherMonths:true,
            dateFormat:'yy/mm/dd'
        });
    }

});
