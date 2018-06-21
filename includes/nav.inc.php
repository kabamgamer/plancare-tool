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
                    <div class="form-group">
                        <input type="search" placeholder="Zoek Klant" class="form-control" id="searchCustomer" name="searchCustomer" autocomplete="off">
                    </div>
                </div>
            </li>
        </ul>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <form id="createCustomer" class="navbar-form" action="" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Naam" id="customerName" name="customerName" value="<?= \formHandlers\Input::get("customerName") ?>">
                        <div class="input-group-append">
                            <input type="submit" class="btn btn-outline-secondary" value="Aanmaken" name="submitCustomer" id="submitCustomer">
                        </div>
                    </div>
                </form>
            </li>
        </ul>
    </div>

    <a href="logout.php" style="font-size:1.5em"><i class="fas fa-sign-out-alt"></i></a>
</nav>
