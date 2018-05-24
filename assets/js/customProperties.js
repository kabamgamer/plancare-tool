// Hide error/success messages after 5 seconds
$('#hide').delay(5000).fadeOut(500);

/**
 * Form validations
 */
$(function() {
        $("#creatCustomer").validate({
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