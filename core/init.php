<?php
// Define Root Folder
define("ROOT", __DIR__."/..");

// Autoloader
require_once __DIR__."/../vendor/autoload.php";

spl_autoload_register(function ($class){
    $filename = $class.'.php';

    chdir(__DIR__.'/../classes/');
    $filename = str_replace("\\","/", $filename);

    if(!file_exists($filename)){
        return false;
    } else{
        include $filename;
    }
});

if(isset($_GET["accessToken"])) {
    $tokenParts = explode(".", $_GET["accessToken"]);
    setcookie("accessToken", $_GET["accessToken"], $tokenParts[2]);
}

if(!isset($_COOKIE["accessToken"])) {
    header("Location: https://inloggen.tapcare.nl/domain/arnoud.plancareweb.nl?returnUri=localhost:8000");
    exit;
}