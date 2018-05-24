<?php

namespace formHandlers;


class Input
{

    public static function exists($type = 'post')
    {
        switch ($type){
            case 'post':
                return (!empty($_POST) ? true : false);
            break;
            case 'put':
                return (!empty($_GET) ? true : false);
            break;
            default:
                return false;
            break;
        }
    }

    public static function get($item)
    {
        if(isset($_POST[$item])){
            return htmlspecialchars($_POST[$item]);
        } elseif($_GET[$item]) {
            return htmlspecialchars($_GET[$item]);
        } else{
            return '';
        }
    }
}