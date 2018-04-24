<?php

namespace validators;

class Validator
{
    public static function service($serviceName, $customer)
    {
        session_start();

        // Check if empty
        if(empty($serviceName) && empty($customer)){
            $_SESSION["error"] = "De velden \"Service naam\" en \"Klant\" zijn verplicht.";
            header("Location: /index.php");
            exit();
        } else{
            if(empty($serviceName)){
                $_SESSION["error"] = "Het veld \"Service naam\" is verplicht.";
                header("Location: /index.php?customer=$customer");
                exit();
            } else {
                if(empty($customer)){
                    $_SESSION["error"] = "Het veld \"Klant\" is verplicht.";
                    header("Location: /index.php?serviceName=$serviceName");
                    exit();
                } else {

                    // Check for char paterns
                    if(!preg_match("/^[a-zA-Z0-9 \/,]*$/", $serviceName)){
                        $_SESSION["error"] = "Het veld \"Service naam\" mag alleen hoofdletters, kleine letters, slashes en spaties bevatten.";
                        header("Location: /index.php?customer=$customer&serviceName=$serviceName");
                        exit();
                    } else {
                        if(!preg_match("/^[a-zA-Z0-9 ]*$/", $customer)){
                            $_SESSION["error"] = "Het veld \"Klant\" mag alleen hoofdletters, kleine letters, cijfers, komma, voorwaardse slash en spaties bevatten.";
                            header("Location: /index.php?customer=$customer&serviceName=$serviceName");
                            exit();
                        } else{
                            return true;
                        }
                    }

                }
            }
        }
    }
}