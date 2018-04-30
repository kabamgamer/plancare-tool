<?php

use API\CallAPI;

$page = $_SERVER[REQUEST_URI];

// Get services form API
$result = new CallAPI;
$results = $result->getCustomers();
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse nav-right container" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Customers
                </a>
                <div class="dropdown-menu active" aria-labelledby="navbarDropdown">
                    <?php
                    foreach ($results as $customer){
                        $customerId = $customer["id"];
                        $customerName = $customer["name"];
                        $active = ($page == "index.php?customerId=$customerId" ? "active" :"");
                        echo "<a class=\"dropdown-item $active\" href=\"index.php?customerId=$customerId\">$customerName</a>";
                    }
                    ?>
                </div>
            </li>
        </ul>
    </div>
</nav>