<?php

spl_autoload_register(function ($classname) {
    $classname = str_replace("App\\", "", $classname);
    $classname = "." . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $classname) . ".php";
    if (file_exists($classname)) {
        require_once($classname);
    }
});
