/**
 * Created by Ricardo on 1/18/2015.
 */
$(document).ready(function() {

    $('.openDialogFormularios').click(function () {
        var nombre_paciente = $(this).attr('data-name');
        $('#formularios-modal').dialog('open');
        return false;
    });

    $("#formularios-modal").dialog({
        autoOpen: false,
        "title": "Consulta a realizar",
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