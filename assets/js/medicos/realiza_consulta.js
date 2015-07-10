/**
 * Created by Ricardo on 1/18/2015.
 */
$(document).ready(function() {

    $('#openDialogFicha').click(function () {
        $('#ficha-paciente-modal').dialog('open');
        return false;
    });

    $("#ficha-paciente-modal").dialog({
        autoOpen: false,
        "title": "Ficha del paciente",
        "buttons": {
            "OK": function () {
                $(this).dialog("close");
            }
        }
    })
        .dialogExtend({
            "close": true,
            "maximize": true,
            "minimize": true,
            "dblclick": "collapse",
            "icons": {
                "close": "ui-icon-circle-close",
                "maximize": "ui-icon-circle-plus",
                "minimize": "ui-icon-circle-minus",
                "restore": "ui-icon-bullet"
            }
        });

    $('#openDialogHistorial').click(function () {
        $('#historial-modal').dialog('open');
        return false;
    });

    $("#historial-modal").dialog({
        autoOpen: false,
        "title": "Historial medico",
        "buttons": {
            "OK": function () {
                $(this).dialog("close");
            }
        }
    })
        .dialogExtend({
            "close": true,
            "maximize": true,
            "minimize": true,
            "dblclick": "collapse",
            "icons": {
                "close": "ui-icon-circle-close",
                "maximize": "ui-icon-circle-plus",
                "minimize": "ui-icon-circle-minus",
                "restore": "ui-icon-bullet"
            }
        });
});