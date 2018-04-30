<?php

namespace validators;

class Validator
{
    public static function postService($customerId, $serviceName, $customer)
    {
        session_start();

        // Check if empty
        if (empty($serviceName)) {
            $_SESSION["error"] = "Het veld \"Service naam\" is verplicht.";
            header("Location: /index.php?customerId=$customerId");
            exit();
        } else {

            // Check for char paterns
            if (!preg_match("/^[a-zA-Z0-9 \/,]*$/", $serviceName)) {
                $_SESSION["error"] = "Het veld \"Service naam\" mag alleen hoofdletters, kleine letters, slashes en spaties bevatten.";
                header("Location: /index.php?customerId=$customerId&customer=$customer&serviceName=$serviceName");
                exit();
            } else {
                return true;
            }
        }
    }

    public static function updateProperty($serviceId, $url, $key, $username, $password)
    {
        session_start();

        // Check if empty
        if (empty($url)) {
            $_SESSION["error"] = "Het veld \"API Url\" is verplicht.";
            header("Location: /properties.php?serviceId=$serviceId");
            exit();
        } else {
            if (empty($key)) {
                $_SESSION["error"] = "Het veld \"API Key\" is verplicht.";
                header("Location: /properties.php?serviceId=$serviceId");
                exit();
            } else {
                if (empty($username)) {
                    $_SESSION["error"] = "Het veld \"API Gebruikersnaam\" is verplicht.";
                    header("Location: /properties.php?serviceId=$serviceId");
                    exit();
                } else {
                    if (empty($password)) {
                        $_SESSION["error"] = "Het veld \"API Wachtwoord\" is verplicht.";
                        header("Location: /properties.php?serviceId=$serviceId");
                        exit();
                    } else {
                        return true;
                    }
                }
            }
        }
    }
}