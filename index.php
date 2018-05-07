<?php
namespace formHandlers;

use \API\CallAPI;

session_start();
include "autoload.php";

$api = new CallAPI;
$responseHeaders = $api->getServices("?projects.customerID=11&limit=10&offset=0")["headers"];

foreach ($responseHeaders as $header => $value){
    echo $header . " " . $value;
}

print "<pre>";
print_r($responseHeaders);
print "</pre>";


?><!DOCTYPE html>
<html>
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">


    <title>PlanCare Implemmentatietool - Home</title>
</head>

<body>
<?php
    include "includes/nav.inc.php";

    /**
     * Validate addServices form
     */
    if(Input::exists()){
        $validate = new Validator;
        $validation = $validate->check($_POST, array(
            'serviceName' => [
                "name" => "Service naam",
                "isRequired" => true,
                "minLength" => 2,
                "matchChars" => "a-zA-Z0-9 \/"
            ]
        ));

        if($validation->passed("Project succesvol aangemaakt")){
            $api = new CallAPI;

            $data = array(
                "customerId" => $_POST["customerId"],
                "name" => $_POST["serviceName"]
            );

            if($api->postService($data)){
                echo "<div class='alert alert-success container' id='hide'>" . $validation->success() . "</div>";
            }
        } else {
            foreach($validate->errors() as $error) {
                echo "<div class='alert alert-danger container' id='hide'> {$error} </div>";
            }
        }
    }
?>


<div class="container">

    <!-- New customer -->
    <?php if(isset($_GET["customerId"]) && !empty(($_GET["customerId"]))){ ?>

    <div class="row">
        <div class="col-md-8 col-sm-8">
            <h2>Nieuwe PlanCare service</h2>
        </div>
        <div class="col-md-4 col-sm-4 align-right">


            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Toevoegen</button>
        </div>
    </div>

    <hr>

    <script>
        var emptyTable = document.getElementsByClassName("dataTables_empty");
        emptyTable.innerHTML = "Kier eerst een klant"
    </script>
    <?php } ?>

    <h2>Alle PlanCare services</h2>

    <!-- Services -->
    <table id="services" class="table display">
        <thead>
        <tr>
            <th>Id</th>
            <th>Service</th>
            <th>Project</th>
            <th>Versie</th>
            <th></th>
        </tr>
        </thead>
    </table>
    <?php include "includes/modal.inc.php";?>

</div>

<div id="customerId" style="display: none">
    <?php
        $customerId = $_GET['customerId'];
        echo htmlspecialchars($customerId);
    ?>
</div>

</body>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.validate.js"></script>
<script src="assets/js/customHome.js"></script>

</html>