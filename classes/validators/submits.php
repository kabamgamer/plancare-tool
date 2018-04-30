<?php

namespace validators;

use API\CallAPI;

require "../../autoload.php";

if(isset($_POST["submitServicePost"])) {

    $data = array(
        "name" => $_POST["serviceName"],
        "customer" => $_POST["customer"],
        "customerId" => $_POST["customerId"],
        "type" => $_POST["type"]
    );

    if(Validator::postService($data["customerId"], $data["name"], $data["customer"]) === true){
        $api = new CallAPI;

        if($api->postService($data)){
            header("Location: \index.php?customerId=".$data["customerId"]);
            $_SESSION["success"] = "Het project is succesvol aangemaakt!";
        } else{
            header("Location: \index.php");
            $_SESSION["error"] = "Er ging iets mis met het aanmaken van de service. Probeer het opnieuw.";
        }
    }
}

if(isset($_POST["submitServicePut"])) {
    $serviceId = $_POST["serviceId"];

    $data = array(
        "rest_service_address" => $_POST["rest_service_address"],
        "rest_api_key" => $_POST["rest_api_key"],
        "username" => $_POST["username"],
        "password" => $_POST["password"]
    );

    if(Validator::updateProperty($serviceId, $data["rest_service_address"], $data["rest_api_key"], $data["username"], $data["password"]) === true){
        $api = new CallAPI;

        if(!$api->updateProperty($serviceId, $data)){
            header("Location: \properties.php?serviceId=$serviceId");
            $_SESSION["success"] = "De service is succesvol geupdate!";
        } else{
            header("Location: \properties.php?serviceId=$serviceId");
            $_SESSION["error"] = "Er ging iets mis met het updaten van de service. Probeer het opnieuw.";
        }
    }
} else{
    header("Location: \index.php");
    exit();
}