<?php

require_once __DIR__.'/app/controllers/customersController.php';
require_once __DIR__.'/app/models/customersModel.php';
require_once __DIR__.'/app/controllers/citiesController.php';
require_once __DIR__.'/app/models/citiesModel.php';
require_once __DIR__.'/config/config.php';
require_once __DIR__.'/lib/DB/MysqliDb.php';

$request = $_SERVER['REQUEST_URI']; 
define('BASE_PATH', '/Tourism-Agency/');
// echo $_SERVER['REQUEST_URI'];


spl_autoload_register(
    function ($class) {
        if (file_exists("app/models/$class.php")) {
            require "app/models/$class.php";
        }
        if (file_exists("app/controllers/$class.php")) {
            require "app/controllers/$class.php";
        }
    }
);
$request = $_SERVER["REQUEST_URI"];
define('BASE_PATH', '/mvc/');
// echo $_SERVER['REQUEST_URI'];
$config = require 'config/config.php';
$db = new \MysqliDb(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);


$customerController = new customersController($db);
$customersModel = new customersModel($db);
$citiesController = new citiesController($db);
$citiesModel = new citiesModel($db);


switch($request)
    {
    case BASE_PATH . 'showCustomers' : $customerController->showCustomers();//💯
    break;
    case BASE_PATH . 'addCustomer' : $customerController->addCustomer();//💯
    break;
    case BASE_PATH . 'deleteCustomer?id=' . @$_GET['id'] : $customerController->deleteCustomer($_GET['id']);//💯
    break;
    case BASE_PATH . 'updateCustomer?id=' . @$_GET['id'] : $customerController->updateCustomer($_GET['id']);//💯
    break;
    case BASE_PATH . 'getCustomerByid?id=' . @$_GET['id'] : $customerController->getCustomerByid($_GET['id']);//💯
    break;
    case BASE_PATH . 'getCustomerByname?name=' . @$_GET['name'] : $customerController->getCustomerByname($_GET['name']);//💯
    break;



    case BASE_PATH . 'showCities' : $citiesController->showCities();//💯
    break;
    case BASE_PATH . 'addCity' : $citiesController->addCity();//💯
    break;
    case BASE_PATH . 'updateCity?id=' . @$_GET['id'] : $citiesController->updateCity($_GET['id']);//💯
    break;
    case BASE_PATH . 'deleteCity?id=' . @$_GET['id'] : $citiesController->deleteCity($_GET['id']);//💯
    break;
    case BASE_PATH . 'getCityByid?id=' . @$_GET['id'] : $citiesController->getCityByid($_GET['id']);//💯
    break;
    case BASE_PATH . 'getCityByname?name=' . @$_GET['name'] : $citiesController->getCityByname($_GET['name']);
    break;    
    default : break;
}

?>

