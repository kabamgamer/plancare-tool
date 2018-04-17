<?php
//namespace Validator;

class validator
{
    public function service($name, $customer)
    {
        session_start();

        // Check if empty
        if(empty($name) && empty($customer)){
            $_SESSION["error"] = "De velden \"Naam\" en \"Klant\" zijn verplicht.";
            header("Location: /index.php");
            exit();
        } else{
            if(empty($name)){
                $_SESSION["error"] = "Het veld \"Naam\" is verplicht.";
                header("Location: /index.php?customer=$customer");
                exit();
            } else {
                if(empty($customer)){
                    $_SESSION["error"] = "Het veld \"Klant\" is verplicht.";
                    header("Location: /index.php?name=$name");
                    exit();
                } else {

                    // Check for char paterns
                    if(!preg_match("/^[a-zA-z ]*$/", $name) && !preg_match("/^[a-zA-z ]*$/", $customer)){
                        $_SESSION["error"] = "De velden \"Naam\" en \"Klant\" mogen alleen hoofdletters, kleine letters en spaties bevatten.";
                        header("Location: /index.php?name=$name&customer=$customer");
                        exit();
                    } else{
                        if(!preg_match("/^[a-zA-z ]*$/", $name)){
                            $_SESSION["error"] = "Het veld \"Naam\" mag alleen hoofdletters, kleine letters en spaties bevatten.";
                            header("Location: /index.php?name=$name&customer=$customer");
                            exit();
                        } else {
                            if(!preg_match("/^[a-zA-z ]*$/", $customer)){
                                $_SESSION["error"] = "Het veld \"Klant\" mag alleen hoofdletters, kleine letters en spaties bevatten.";
                                header("Location: /index.php?name=$name&customer=$customer");
                                exit();
                            } else{
                                $_SESSION["success"] = "PlanCare service is succesvol aangemaakt";
                                header("Location: /index.php");
                                exit();
                            }
                        }
                    }
                }
            }
        }
    }
}