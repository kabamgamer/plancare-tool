<?php

use API\CallAPI;

$page = $_SERVER[REQUEST_URI];

// Get customers form API
$result = new CallAPI;
$results = $result->getCustomers("?limit=10")["body"];
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse container" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Customers
                </a>
                <div class="dropdown-menu active" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item <?= ($_GET['customerId'] == 0 ? 'active' : '') ?>" href="index.php?customerId=0">Alle Services</a>
                    <div class="dropdown-divider"></div>
                    <input type="search" placeholder="Zoeken" class="form-control" id="searchCustomer" name="searchCustomer" autocomplete="off">
                    <?php
                    foreach ($results as $customer){
                        $customerId = $customer["id"];
                        $customerName = $customer["name"];
                        $active = ($page == "/index.php?customerId=$customerId" ? "active" :"");
                        echo "<a class=\"dropdown-item $active\" href=\"index.php?customerId=$customerId\">$customerName</a>";
                    }
                    ?>
                </div>
            </li>
        </ul>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <form class="navbar-form" action="" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Naam" name="customerName" value="<?= \formHandlers\Input::get("customerName") ?>">
                        <div class="input-group-append">
                            <input type="submit" class="btn btn-outline-secondary" value="Aanmaken" name="postCustomer">
                        </div>
                    </div>
                </form>
            </li>
        </ul>
    </div>
</nav>