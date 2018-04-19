<?php

namespace validators;

use API\CallAPI;

require "../../autoload.php";

if(isset($_POST["submit"])) {

    $name = $_POST["name"];
    $customer = $_POST["customer"];
    $type = $_POST["type"];

    if(Validator::service($name, $customer) === true){
        header("Location: \index.php");
        $_SESSION["success"] = "Het project is succesvol aangemaakt!";
    }
} else{
    header("Location: \index.php");
    exit();
}