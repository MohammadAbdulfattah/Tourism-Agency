<?php
session_start();
require_once 'config/config.php';
require_once 'lib/DB/MysqliDb.php';

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
$db = new MysqliDb(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);

$bookingModel = new bookingModel($db);
$bookingController = new bookingController($bookingModel);
$hotelsModel = new HotelsModel($db);
$hotelsController = new HotelsController($hotelsModel);

switch ($request) {
    case BASE_PATH:
    $hotelsController->allHotels();
        break;
    case BASE_PATH . 'showHotel?id=' . @$_GET['id']:
        $hotelsController->getHotelByID($_GET['id']);
        break;
    case BASE_PATH . 'showHotelName?id=' . @$_GET['id']:
        $hotelsController->getHotelName($_GET['id']);
        break;
    case BASE_PATH . 'showHotelSpc':
        $hotelsController->getHotelsBySpcInfo();
        break;
    case BASE_PATH . 'showHotelByPhone?phone=' . @$_GET['phone']:
        $hotelsController->getHotelsByPhone($_GET['phone']);
        break;
    case BASE_PATH . 'showHotelByName?name=' . @$_GET['name']:
        $hotelsController->getHotelByName($_GET['name']);
        break;
    case BASE_PATH . 'showHotelsByCity?cityName=' . @$_GET['cityName']:
        $hotelsController->getHotelsByCity($_GET['cityName']);
        break;
    case BASE_PATH . 'addHotel':
        $hotelsController->addHotel();
        break;
    case BASE_PATH . 'editHotel?id=' . @$_GET['id']:
        $hotelsController->editHotel();
        break;
    case BASE_PATH . 'editHotelByName?hotelName=' . @$_GET['hotelName']:
        $hotelsController->editHotelByName();
        break;
    case BASE_PATH . 'editHotelByCity?cityName=' . @$_GET['cityName']:
        $hotelsController->editHotelByCity();
        break;
    case BASE_PATH . 'editHotelByPhone?phone=' . @$_GET['phone']:
        $hotelsController->editHotelByPhone();
        break;
    case BASE_PATH . 'deleteHotel?id=' . @$_GET['id']:
        $hotelsController->deleteHotel();
        break;
    case BASE_PATH . 'deleteHotelByCity?cityName=' . @$_GET['cityName']:
        $hotelsController->deleteHotelByCity();
        break;
    case BASE_PATH . 'allBookings':
        $bookingController->allBookings();
        break;
    case BASE_PATH . 'showBookingSpc':
        $bookingController->getBookingBySpcInfo();
        break;
    case BASE_PATH . 'showBookingByID?id=' .@$_GET['id']:
        $bookingController->getBookingByID($_GET['id']);
        break;
    case BASE_PATH . 'showBookingByHotel?hotelName=' .@$_GET['hotelName']:
        $bookingController->getBookingByHotel($_GET['hotelName']);
        break;
    case BASE_PATH . 'showBookingByCustomer?customerName=' .@$_GET['customerName']:
        $bookingController->getBookingByCustomer($_GET['customerName']);
        break;
    case BASE_PATH . 'showBookingByDate?date=' .@$_GET['date']:
        $bookingController->getBookingByDate($_GET['date']);
        break;
    case BASE_PATH . 'showBookingByTicket?ticket_id=' .@$_GET['ticket_id']:
        $bookingController->getBookingByTicket($_GET['ticket_id']);
        break;
    case BASE_PATH . 'addBooking':
        $bookingController->addBooking();
        break;
    case BASE_PATH . 'editBooking?id='.@$_GET['id']:
        $bookingController->editBooking();
        break;
    case BASE_PATH . 'editBookingByCustomer?customerName='.@$_GET['customerName']:
        $bookingController->editBookingByCustomer();
        break;
    case BASE_PATH . 'editByTicket?ticket_id='.@$_GET['ticket_id']:
        $bookingController->editBookingByTicket();
        break;
    case BASE_PATH . 'editBookingByHotel?hotelName='.@$_GET['hotelName']:
        $bookingController->editBookingByHotel();
        break;
    case BASE_PATH . 'editBookingByDate?=date'.@$_GET['date']:
        $bookingController->editBookingByDate();
        break;
    case BASE_PATH . 'deleteBooking?=id'.@$_GET['id']:
        $bookingController->deleteBooking();
        break;
    default:
        echo "action not found!!";
        break;
}
