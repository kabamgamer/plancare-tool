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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script src="assets/js/custom.js"></script>


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

    <h2>Alle PlanCare services</h2>

    <!-- Services -->
    <table id="services" class="table display">
        <thead>
        <tr>
            <th>Id</th>
            <th>Service</th>
            <th>URL</th>
            <th>Class</th>
<!--            <th>Project</th>-->
<!--            <th>Type</th>-->
<!--            <th>Klant</th>-->
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
                      <td>".$service['name']."</td>
                      <td>".$service['href']."</td>
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
</html>