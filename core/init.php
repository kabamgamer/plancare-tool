<?php
// Define Root Folder
define("ROOT", __DIR__."/..");

// Autoloader
require_once ROOT."/vendor/autoload.php";

spl_autoload_register(function ($class){
    $filename = $class.'.php';

    chdir(ROOT.'/classes/');
    $filename = str_replace("\\","/", $filename);

    if(!file_exists($filename)){
        return false;
    } else{
        include $filename;
    }
});

$DotENV = new \Dotenv\Dotenv(ROOT);
$DotENV->load();

error_reporting($_ENV["ERROR_REPORTING"]);

if(isset($_GET["accessToken"])) {
    $tokenParts = explode(".", $_GET["accessToken"]);
    Cookie::set("accessToken", $_GET["accessToken"], $tokenParts[2]);
}

if(!Cookie::exists("accessToken")) {
    header("Location: ".$_ENV["LOGIN_PORTAL"]);
    exit;
}