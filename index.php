<?php
require_once 'app/controllers/bookingController.php';
require_once 'app/controllers/adminsController.php';
require_once 'app/controllers/ratesController.php';
require_once 'app/models/ratesModel.php';
require_once 'app/models/bookingModel.php';
require_once 'app/models/adminsModel.php';
require_once 'config/config.php';
require_once 'lib/DB/MysqliDb.php';

$config = require 'config/config.php';
$db = new MysqliDb(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);


$request = $_SERVER['REQUEST_URI'];

define('BASE_PATH', '/my-github/tourism-agency/');

$rate = new RatesController($db);
$admin = new AdminsControllers($db);

$rate->index();
/*switch ($request) {
    case BASE_PATH:
        $admin->index();
        break;
    case BASE_PATH . 'login':
        $admin->login();
        break;
    case BASE_PATH . 'register':
        $admin->register();
        break;
}*/