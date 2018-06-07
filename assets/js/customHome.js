// Hide error/success messages after 5 seconds
$('#hide').delay(5000).fadeOut(500);

/**
 * Datatable config
 */
$(document).ready( function () {
    var path = window.location.search;
    var index = path.indexOf("=");
    var and = path.indexOf("&");
    var customerId = path.substring(index+1);

    if(and !== null && and !== -1) {
        customerId = path.substring(and, index+1);
    }

    console.log(customerId);

    $('#services').DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [
            [10, 25, 50],
            [10, 25, 50]
        ],
        language: {
            sLengthMenu: "_MENU_ resultaten weergeven",
            sProcessing: "PlanCare services ophalen &nbsp<img src=\"http://loadinggif.com/images/image-selection/3.gif\" height='40px'>",
            sZeroRecords: "Kies eerst een klant.",
            sInfo: "_START_ tot _END_ van _TOTAL_ resultaten",
            sInfoEmpty: "Geen resultaten om weer te geven",
            sInfoFiltered: " (gefilterd uit _MAX_ resultaten)",
            sInfoPostFix: "",
            sSearch: "Zoeken:",
            sEmptyTable: "Geen PlanCare services gevonden",
            sInfoThousands: ".",
            sLoadingRecords: "Een moment geduld aub - bezig met laden...",
            oPaginate: {
                sFirst: "Eerste",
                sLast: "Laatste",
                sNext: "Volgende",
                sPrevious: "Vorige"
            },
            oAria: {
                sSortAscending:  ": activeer om kolom oplopend te sorteren",
                sSortDescending: ": activeer om kolom aflopend te sorteren"
            }
        },
        ajax:{
            type:"POST",
            url: "../../classes/API/ajax/ajaxCallDataTable.php",
            data: {
                customerId: customerId
            }
        },
        initComplete : function( settings, json){
            var jsonData = json.data[0];

            $('div.loading').remove();

            if(jsonData.length === 1) {
                var error = document.getElementsByClassName("sorting_1");
                var td = document.getElementsByTagName("TD");

                $(error).attr('colspan', 5);
                $(error).css('text-align', 'center');
                $(td[1]).css('display', 'none');
                $(td[2]).css('display', 'none');
                $(td[3]).css('display', 'none');
                $(td[4]).css('display', 'none');
            }
        },
        drawCallback: function( settings ) {
            $(document.getElementById('services_processing')).css('display', 'none');
        },
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
        }]
    });
} );

/**
 * Form validations
 */
$(function() {
    $("#createCustomer").validate({
        rules: {
            customerName: {
                required: true
            }
        },
        messages: {
            customerName: {
                required: ""
            }
        },

        submitHandler: function(form) {
            var button = document.getElementById("submitCustomer");

            button.setAttribute("disabled", "disabled");
            button.classList.add("loading");

            form.submit();
        }
    });

    // Validate Services
    $("#addService").validate({
        rules: {
            serviceName: {
                required: true,
                serviceNameChars: true
            }
        },

        messages: {
            serviceName: {
                required: "Dit veld is verplicht",
                serviceNameChars: "Dit veld mag alleen hoofdletters, kleine letters, cijfers, slashes en spaties bevatten."
            }
        },
        submitHandler: function(form) {
            var button = document.getElementById("submit-button");
            var body = document.getElementsByTagName("BODY")[0];
            var i;

            button.setAttribute("disabled", "disabled");
            button.classList.add("loading");

            form.submit();
        }
    });

    $("#serviceName").focus(function () {
        var customer = $("#customer").val();
        var type = $("#type").val().substring(0, 4).toUpperCase();

        // Redirecting
        if(!customer) {
            window.location.assign("index.php");
        }

        // Autocomplete
        if(customer && type && !this.value) {
            this.value = customer + "/" + type;
        }

        if($("#addService").valid())
        {
            $("#submit-button").removeAttr("disabled");
        }
    });
});

// Custom validator
jQuery.validator.addMethod("serviceNameChars", function (value, element) {
    return this.optional(element) || /^[a-zA-Z0-9,\/! ]*$/.test(value);
}, "Dit veld mag alleen hoofdletters, kleine letters, cijfers, komma, voorwaardse slash en spaties bevatten.");