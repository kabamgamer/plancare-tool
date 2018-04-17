<?php

include "validator.php";

if(isset($_POST["submit"])) {

    $name = $_POST["name"];
    $customer = $_POST["customer"];
    $type = $_POST["type"];

    $errors = new validator();
    $errors->service($name, $customer);
} else{
    header("Location: \index.php");
    exit();
}