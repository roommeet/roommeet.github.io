<?php

header("Access-Control-Allow-Origin: *");

spl_autoload_register(function ($class){
    require_once __DIR__."/$class" . ".php";
});

?>