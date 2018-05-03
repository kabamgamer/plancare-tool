// Hide error/success messages after 5 seconds
setTimeout(function(){
    document.getElementById('hide').style.display = 'none';
    document.getElementById('hide').innerHTML = '';
}, 5000);

/**
 * Form validation putServices
 */
$(function() {
    $("#putService").validate({
        rules: {
            rest_service_address: {
                required: true
            },
            rest_api_key: {
                required: true
            },
            username: {
                required: true
            },
            password: {
                required: true
            }
        },

        messages: {
            serviceName: {
                required: "Dit veld is verplicht"
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
});