<?php

namespace validators;

use API\CallAPI;

require "../../autoload.php";

if(isset($_POST["submitServicePost"])) {

    $data = array(
        "name" => $_POST["serviceName"],
        "customer" => $_POST["customer"],
        "type" => $_POST["type"]
    );

    if(Validator::service($data["name"], $data["customer"]) === true){
        $api = new CallAPI;

        if($api->postService($data)){
            header("Location: \index.php");
            $_SESSION["success"] = "Het project is succesvol aangemaakt!";
        } else{
            header("Location: \index.php");
            $_SESSION["error"] = "Er ging iets mis met het aanmaken van de service. Probeer het opnieuw.";
        }
    }
} else{
    header("Location: \index.php");
    exit();
}