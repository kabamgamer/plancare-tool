setTimeout(function(){
    document.getElementById('hide').style.display = 'none';
    document.getElementById('hide').innerHTML = '';
}, 5000);

$(document).ready( function () {
    $('#services').DataTable();
} );

$(function() {
    $("#addService").validate({
        rules: {
            customer: {
                required: true,
                customerChars: true
            },
            serviceName: {
                required: true,
                serviceNameChars: true
            }
        },

        messages: {
            customer: {
                required: "Dit veld is verplicht",
                customerChars: "Dit veld mag alleen hoofdletters, kleine letters, cijfers en spaties bevatten."
            },
            serviceName: {
                required: "Dit veld is verplicht",
                serviceNameChars: "Dit veld mag alleen hoofdletters, kleine letters, cijfers, slashes en spaties bevatten."
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    // Autocomplete
    $("#serviceName").focus(function () {
        var customer = $("#customer").val();
        var type = $("#type").val();

        if(customer && type && !this.value) {
            this.value = customer + "/" + type;
        }
    })
});

jQuery.validator.addMethod("customerChars", function (value, element) {
    return this.optional(element) || /^[a-zA-Z0-9 ]*$/.test(value);
}, "Dit veld mag alleen hoofdletters, kleine letters, cijfers en spaties bevatten.");

jQuery.validator.addMethod("serviceNameChars", function (value, element) {
    return this.optional(element) || /^[a-zA-Z0-9,\/ ]*$/.test(value);
}, "Dit veld mag alleen hoofdletters, kleine letters, cijfers, komma, voorwaardse slash en spaties bevatten.");