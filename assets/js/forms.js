// document ready function
$(document).ready(function() { 	

    /*MASCARAS*/
    $(".nit").mask("9999-999999-999-9");
    $(".dui").mask("99999999-9");

	//------------- Datepicker -------------//
	if($('.datepicker').length) {
		$(".datepicker").datepicker({
			showOtherMonths:true
		});
	}
});//End document ready functions
