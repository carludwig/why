<?php
require_once "controllers/startcontroller.php";
require_once "controllers/wallcontroller.php";




//$requestURI = explode("/", parse_url(trim(strtolower($_SERVER["REQUEST_URI"]), "/"), PHP_URL_PATH));
session_start();
$requestURI = explode("/", strtolower($_SERVER["REQUEST_URI"]));

$controller = "startcontroller";
$action = "indexAction";

if(!empty($requestURI[2])) {
    $controller = $requestURI[2] . "Controller";
}

if(!empty($requestURI[3])) {
    $action = $requestURI[3] . "Action";
}

if(method_exists($controller, $action)){
    $obj = new $controller;
    $obj->$action();
}
else{
    //echo "404" . $controller ." " . $action;
    require_once "views/404.php";
}
