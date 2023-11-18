<?php
namespace index;
use app\controllers\customersController;
use app\models\customersModel;
use app\controllers\citiesController;

require_once __DIR__.'/app/controllers/customersController.php';
require_once __DIR__.'/app/models/customersModel.php';
require_once __DIR__.'/config/config.php';
require_once __DIR__.'/lib/DB/MysqliDb.php';

$config = require 'config/config.php';
$db = new \MysqliDb(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);

$request = $_SERVER['REQUEST_URI'];
 
define('BASE_PATH', '/Tourism-Agency/');

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