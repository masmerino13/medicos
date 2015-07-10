// document ready function
$(document).ready(function() { 	

	//--------------- Accordion ------------------//
    var acc = $('.accordion'); //get all accordions
    var accHeading = acc.find('.accordion-heading');
	var accBody = acc.find('.accordion-body');

	//function to put icons
	accPutIcon = function () {
		acc.each(function(index) {
		   accExp = $(this).find('.accordion-body.in');
		   accExp.prev().find('a.accordion-toggle').append($('<span class="icon12 entypo-icon-minus-2 gray"></span>'));

		   accNor = $(this).find('.accordion-body').not('.accordion-body.in');
		   accNor.prev().find('a.accordion-toggle').append($('<span class="icon12 entypo-icon-plus-2 gray"></span>'));


		});
	}

	//function to update icons
	accUpdIcon = function() {
		acc.each(function(index) {
		   accExp = $(this).find('.accordion-body.in');
		   accExp.prev().find('span').remove();
		   accExp.prev().find('a.accordion-toggle').append($('<span class="icon12 entypo-icon-minus-2 gray"></span>'));

		   accNor = $(this).find('.accordion-body').not('.accordion-body.in');
		   accNor.prev().find('span').remove();
		   accNor.prev().find('a.accordion-toggle').append($('<span class="icon12 entypo-icon-plus-2 gray"></span>'));


		});
	}

	accPutIcon();

	$('.accordion').on('shown', function () {
		accUpdIcon();
	}).on('hidden', function () {
		accUpdIcon();
	})

    //--------------- Dialogs ------------------//
    /*$('.openModalDialog').on('click', function(){
        var modal = $(this).attr('data-modal');
        $(modal).dialog('open');
        return false;
    });*/

    $('#openModalDialog').click(function(){
        $('#modal').dialog('open');
        return false;
    });

    // JQuery UI Modal Dialog
    $('#modal').dialog({
        autoOpen: false,
        modal: true,
        dialogClass: 'dialog',

        buttons: {
            "Close": function() {
                $(this).dialog("close");
            }
        }
    });

    $("div.dialog button").addClass("btn");

});//End document ready functions
