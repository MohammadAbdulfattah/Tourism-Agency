<?php
// namespace index;
session_start();

use app\controllers\customersController;
use app\models\customersModel;
use app\controllers\citiesController;

require_once __DIR__.'/app/controllers/customersController.php';
require_once __DIR__.'/app/models/customersModel.php';
require_once __DIR__.'/config/config.php';
require_once __DIR__.'/lib/DB/MysqliDb.php';

// spl_autoload_register(
//     function ($class){
//         if(file_exists("app/models/$class.php")){
//             require "app/models/$class.php";
//         }
//         if(file_exists("app/controllers/$class.php")){
//             require_once "app/controllers/$class.php";
//         }
//     }
// );

$request = $_SERVER['REQUEST_URI']; 
define('BASE_PATH', '/agency/');
echo $_SERVER['REQUEST_URI'];

$config = require 'config/config.php';
$db = new \MysqliDb(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);

$customerController = new customersController($db);
$customersModel = new customersModel($db);

// $citiesController = new citiesController($db);

var_dump($request);

switch($request)
{
    // case BASE_PATH . 'showCustomers' : $customerController->showCustomers();
    // break;
    case BASE_PATH . 'add' : $customerController->addCustomer();
    break;
    // case BASE_PATH . 'delete?id' . $_GET['id'] : $customerController->deleteCustomer($_GET['id']);
    // break;
    // case BASE_PATH . 'update?id' . $_GET['id'] : $customerController->updateCustomer($_GET['id']);
    // break;
    // case BASE_PATH . 'getCustomerByid?id' . $_GET['id'] : $customerController->getCustomerByid($_GET['id']);
    // break;
    // case BASE_PATH . 'search' : $customerController->searchCustomer($_POST['search_term']);
    // break;
    default : break;
}

?>