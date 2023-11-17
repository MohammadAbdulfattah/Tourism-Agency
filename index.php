<?php
require_once 'app/controllers/bookingController.php';
require_once 'app/models/bookingModel.php';
require_once 'config/config.php';
require_once 'lib/DB/MysqliDb.php';

$config = require 'config/config.php';
$db = new MysqliDb(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);

$model = new BookingModel($db);
