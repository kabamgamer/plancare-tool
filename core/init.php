<?php

// Autoloader
spl_autoload_register(function ($class){
    $filename = $class.'.php';

    chdir('/var/www/html/classes/');
    $filename = str_replace("\\","/", $filename);

    if(!file_exists($filename)){
        return false;
    } else{
        include $filename;
    }
});