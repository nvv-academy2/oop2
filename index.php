<?php

spl_autoload_register(function($class) {
    echo $class."<br>";
    if(strpos($class, "Helper")) {
        if(file_exists("helpers/$class.php")) {
            require_once "helpers/$class.php";
        }
    }

    if(strpos($class, "Model")) {
        if(file_exists("models/$class.php")) {
            require_once "models/$class.php";
        }
    }
});

$db = new DBHelper();
$categroy = new CategoryModel();
$categroy = new OrdersModel();
