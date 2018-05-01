setTimeout(function(){
    document.getElementById('hide').style.display = 'none';
    document.getElementById('hide').innerHTML = '';
}, 5000);

$(document).ready( function () {
    $('#services').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "../../classes/API/ajax/ajaxCall.php",
            type:"POST"
        }
        // ,columnDefs: [{
        //     "defaultContent": "-",
        //     "targets": "_all"
        // }]
    });
} );

$(function() {
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
            button.style.cursor = "progress";
            body.classList.add("wait");

            form.submit();
        }
    });

    // Autocomplete
    $("#serviceName").focus(function () {
        var customer = $("#customer").val();
        var type = $("#type").val().substring(0, 4).toUpperCase();

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