<?php
namespace formHandlers;

use \API\CallAPI,
    \errorHandlers\HttpErrors;

session_start();
include "core/init.php";
?><!DOCTYPE html>
<html>
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <title>PlanCare Implemmentatietool - Properties</title>
</head>

<body>
<?php
    include "includes/nav.inc.php";

    /**
     * Validate putServices form
     */
    if(isset($_POST["submitServicePut"])) {
        if (Input::exists()) {
            $validate = new Validator;
            $validation = $validate->check($_POST, array(
                'rest_service_address' => [
                    "isRequired" => true
                ],
                'rest_api_key' => [
                    "isRequired" => true
                ],
                'username' => [
                    "isRequired" => true
                ],
                'password' => [
                    "isRequired" => true
                ]
            ));

            if ($validation->passed("Eigenschappen succesvol aangepast")) {
                $api = new CallAPI;
                $serviceId = $_GET["serviceId"];

                $data = array(
                    "rest_service_address" => $_POST["rest_service_address"],
                    "rest_api_key" => $_POST["rest_api_key"],
                    "username" => $_POST["username"],
                    "password" => $_POST["password"]
                );

                if (!$api->updateProperty($serviceId, $data)) {
                    echo "<div class='alert alert-success container' id='hide'>" . $validation->success() . "</div>";
                }
            } else {
                foreach ($validate->errors() as $error) {
                    echo "<div class='alert alert-danger container' id='hide'> {$error} </div>";
                }
            }
        }
    }

    /**
     * Validate PostCustomer
     */
    if (isset($_POST["submitCustomer"])) {
        if (Input::exists()) {
            $validate = new Validator;
            $validation = $validate->check($_POST, [
                "customerName" => [
                    "name" => "Klant naam",
                    "isRequired" => true,
                    "minLength" => 2
                ]
            ]);

            if ($validation->passed("Klant succesvol aangemaakt!")) {
                $api = new CallAPI;

                $data = array(
                    "name" => $_POST["customerName"]
                );

                if ($api->postCustomer($data)) {
                    echo "<div class='alert alert-success container' id='hide'>" . $validation->success() . "</div>";
                }
            } else {
                foreach ($validate->errors() as $error) {
                    echo "<div class='alert alert-danger container' id='hide'> {$error} </div>";
                }
            }
        }
    }


    $version = "";
    if(isset($_POST["getVersion"])) {
        $api = new CallAPI;
        if(is_string($api->getVersion($_GET["serviceId"]))){
            $version = $api->getVersion($_GET["serviceId"]);
        } else {
            $version = "";
            echo "<div class='alert alert-danger container' id='hide'>Kon versienummer niet ophalen. Mogelijk is er een fout in de configuratie van de service.</div>";
        }
    }
?>

<a href="index.php?customerId=<?= $_GET['customerId'] ?>"><button class="btn btn-back">❮ Terug</button></a>

<div class="container">
    <h2>Eigenschappen</h2>

    <hr>

    <?php
        $serviceId = $_GET["serviceId"];
        $result = new CallAPI;
        $service = $result->getService($serviceId);
        $httpCheck = new HttpErrors($service["headers"][0]);
        $result = $service["body"];

        if (!$httpCheck->passed()) {
            echo "<div class='alert alert-danger container'>" . $httpCheck->message() . "</div>";
        }
    ?>

    <!-- Form -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="version">Huidige versie</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <input type="text" class="form-control version" id="version" name="version" value="<?= $version ?>" disabled>
                    </div>
                    <form action="" method="post"><button type="submit" name="getVersion" value="" class="form-control refresh"><i class="fas fa-sync-alt"></i></button></form>
                </div>
            </div>

            <hr>

            <form method="post" id="putService" name="putService" action="">
                <input type="hidden" name="serviceId" value="<?= $serviceId ?>">
                <div class="form-group">
                    <label for="rest_service_address">API Url</label>
                    <input type="text" value="<?= $result['rest_service_address'] ?>" class="form-control" name="rest_service_address" id="rest_service_address">
                </div>
                <div class="form-group">
                    <label for="rest_api_key">API Key</label>
                    <input type="text" value="<?= $result['rest_api_key'] ?>" class="form-control" name="rest_api_key" id="rest_api_key">
                </div>
                <div class="form-group">
                    <label for="username">API Gebruikersnaam</label>
                    <input type="text" value="<?= $result['username'] ?>" class="form-control" name="username" id="username">
                </div>
                <div class="form-group">
                    <label for="password">API Wachtwoord</label>
                    <input type="text" value="<?= $result['password'] ?>" class="form-control" name="password" id="password">
                </div>

                <input type="submit" name="submitServicePut" class="btn btn-primary" id="submit-button" value="Opslaan">
            </form>
        </div>
    </div>
</div>
</body>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="jQuery-Bootstrap-4-Typeahead-Plugin/bootstrap3-typeahead.js"></script>
<script src="assets/js/jquery.validate.js"></script>
<script src="assets/js/customProperties.js"></script>
<!-- Font Awesome -->
<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js"></script>

</html>