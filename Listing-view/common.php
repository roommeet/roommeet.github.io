<?php

header("Access-Control-Allow-Origin: *");

spl_autoload_register(function ($class){
    require_once "model/$class" . ".php";
});

?>