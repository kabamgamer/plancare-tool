<?php

namespace errorHandlers;


class HttpErrors
{
    private $_passed,
            $_http,
            $_message;

    public function __construct($http)
    {
        $this->_http = $http;
        $httpStatus = substr($http, 9, 1);

        switch ($httpStatus) {
            case "2" :
                $this->_passed = true;
            break;
            case "4" :
                $http = substr($this->_http, 9, 3);
                switch ($http) {
                    case "400":
                        $this->addMessage("Het systeem kan niet aan deze aanvraag voldoen.");
                    break;
                    case "401":
                        $this->addMessage("U bent niet bevoegd om deze aanvraag te doen.");
                        header("Location: https://inloggen.tapcare.nl/domain/arnoud.plancareweb.nl?returnUri=localhost:8000");
                        exit;
                    break;
                    case "403":
                        $this->addMessage("U bent niet bevoegd om een aanvraag te doen op dit pad.");
                    break;
                    case "404":
                        $this->addMessage("Het pad waarop u een aanvraag doet Lijkt niet te bestaan.");
                    break;
                    case "413":
                        $this->addMessage("Uw aanvraag is te groot om te verwerken.");
                    break;
                    default:
                        $this->addMessage("Er is een onbekende aanvraagfout opgetreden.");
                    break;
                }

                $this->_passed = false;
            break;
            case "5" :
                $http = substr($this->_http, 9, 3);
                switch ($http) {
                    case "500":
                        $this->addMessage("Er is een serverfout opgetreden waardoor we uw verzoek niet kunnen verwerken.");
                    break;
                    case "503":
                        $this->addMessage("De server is momenteel niet bereikbaar. Probeer het later opnieuw!");
                    break;
                    default:
                        $this->addMessage("Er is een onbekende serverfout opgetreden.");
                    break;
                }

                $this->_passed = false;
            break;
            default:
                $this->addMessage("Er is een onbekende fout opgetreden.");

                $this->_passed = false;
            break;
        }
    }


    private function addMessage($error)
    {
        $this->_message = $error;
    }
    public function message()
    {
        return $this->_message;
    }

    public function passed()
    {
        return $this->_passed;
    }
}