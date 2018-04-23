<?php

namespace validators;

use API\CallAPI;

require "../../autoload.php";

if(isset($_POST["submit"])) {

    $serviceName = $_POST["serviceName"];
    $customer = $_POST["customer"];
    $type = $_POST["type"];

    if(Validator::service($serviceName, $customer) === true){
        header("Location: \index.php");
        $_SESSION["success"] = "Het project is succesvol aangemaakt!";
    }
} else{
    header("Location: \index.php");
    exit();
}