<?php
include "autoload.php";

use \API\CallAPI;
?>

<!DOCTYPE html>
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
<a href="index.php"><button class="btn btn-back">❮ Terug</button></a>
<div class="container">
    <h2>Eigenschappen</h2>

    <hr>

    <?php
        $serviceId = $_GET["serviceId"];
        $result = new CallAPI;
        $result = $result->getServices($serviceId);
    ?>

    <!-- Form -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="version">Huidige versie</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <input type="text" class="form-control version" name="version" value="<?= $result['plancare_version'] ?>" disabled>
                    </div>
                    <button class="form-control refresh"><i class="fas fa-sync-alt"></i></button>
                </div>
            </div>

            <hr>

            <form method="post" action="">
                <div class="form-group">
                    <label for="url">API Url</label>
                    <input type="text" value="<?= $result['rest_service_address'] ?>" class="form-control" name="url">
                </div>
                <div class="form-group">
                    <label for="key">API Key</label>
                    <input type="text" value="<?= $result['rest_api_key'] ?>" class="form-control" name="key">
                </div>
                <div class="form-group">
                    <label for="username">API Gebruikersnaam</label>
                    <input type="text" value="<?= $result['username'] ?>" class="form-control" name="username">
                </div>
                <div class="form-group">
                    <label for="password">API Wachtwoord</label>
                    <input type="text" value="<?= $result['password'] ?>" class="form-control" name="password">
                </div>

                <input type="submit" name="submit" class="btn btn-primary" value="Opslaan">
            </form>
        </div>
    </div>
</div>
</body>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<!-- Font Awesome -->
<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js"></script>

</html>