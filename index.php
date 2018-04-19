<?php
include "includes/sessions.inc.php";
include "autoload.php";

use API\CallAPI;
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

    <title>Home</title>
</head>

<body>
    <div class="container">
        <!-- New customer -->
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <h2>Nieuwe PlanCare service</h2>
            </div>
            <div class="col-md-4 col-sm-4 align-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Toevoegen</button>
            </div>
        </div>

        <hr>

        <!-- Search -->
        <div class="row">
            <div class="col-md-9 col-sm-9">
                <h2>Alle PlanCare services</h2>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="form-group">
                    <input type="text" placeholder="Search" class="form-control">
                    
                </div>
            </div>
        </div>

        <!-- Services -->
        <table class="table table-center">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Service</th>
                    <th>Project</th>
                    <th>Type</th>
                    <th>Klant</th>
                    <th></th>
                </tr>
            </thead>

            <!-- All services -->
            <tbody>
                <?php
                    // Get services form API
                    $result = new CallAPI;
                    $results = $result->getServices();

                    // Place services in table
                    foreach($results as $service){
                        echo "
                    <tr>
                        <td>".$service['id']."</td>
                        <td>".$service['googleAnalyticsId']."</td>
                        <td>".$service['href']."</td>
                        <td>".$service['class']."</td>                            
                        <td>".$service['class']."</td>                            
                        <td><a href=\"properties.php?serviceId=".$service['id']."  \" class=\"next\">&#8250;</a></td>                            
                    </tr>";
                    }

                ?>
            </tbody>
        </table>

        <?php include "includes/modal.inc.php"; ?>
    </div>
</body>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="assets/js/custum.js"></script>

</html>