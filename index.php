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
//var_dump ($request);
$config = require 'config/config.php';
$db = new MysqliDb(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);


$bookingController = new bookingController($db);
$hotelsController = new HotelsController($db);
$companiesController = new companiesController($db);
$rateController = new RatesController($db);
$adminController = new AdminsController($db);
$ticketController = new TicketsController($db);
$customerController = new customersController($db);
$citiesController = new citiesController($db);

switch ($request) {
    case BASE_PATH . 'register':
        $adminController->register();
        return;
    case BASE_PATH . 'login':
        $adminController->login();
        return;
}

if ($adminController->check()) {
    switch ($request) {
        case BASE_PATH . 'allHotels':
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
        case BASE_PATH . 'allBookings':
            $bookingController->allBookings();
            break;
        case BASE_PATH . 'showBookingSpc':
            $bookingController->getBookingBySpcInfo();
            break;
        case BASE_PATH . 'showBookingByID?id=' . @$_GET['id']:
            $bookingController->getBookingByID($_GET['id']);
            break;
        case BASE_PATH . 'showBookingByHotel?hotelName=' . @$_GET['hotelName']:
            $bookingController->getBookingByHotel($_GET['hotelName']);
            break;
        case BASE_PATH . 'showBookingByCustomer?customerName=' . @$_GET['customerName']:
            $bookingController->getBookingByCustomer($_GET['customerName']);
            break;
        case BASE_PATH . 'showBookingByDate?date=' . @$_GET['date']:
            $bookingController->getBookingByDate($_GET['date']);
            break;
        case BASE_PATH . 'showBookingByTicket?ticket_id=' . @$_GET['ticket_id']:
            $bookingController->getBookingByTicket($_GET['ticket_id']);
            break;
        case BASE_PATH . 'addBooking':
            $bookingController->addBooking();
            break;
        case BASE_PATH . 'editBooking?id=' . @$_GET['id']:
            $bookingController->editBooking();
            break;
        case BASE_PATH . 'editBookingByCustomer?customerName=' . @$_GET['customerName']:
            $bookingController->editBookingByCustomer();
            break;
        case BASE_PATH . 'editByTicket?ticket_id=' . @$_GET['ticket_id']:
            $bookingController->editBookingByTicket();
            break;
        case BASE_PATH . 'editBookingByHotel?hotelName=' . @$_GET['hotelName']:
            $bookingController->editBookingByHotel();
            break;
        case BASE_PATH . 'editBookingByDate?=date' . @$_GET['date']:
            $bookingController->editBookingByDate();
            break;
        case BASE_PATH . 'deleteBooking?=id' . @$_GET['id']:
            $bookingController->deleteBooking();
            break;
        case BASE_PATH . 'allCompanies':
            $companiesController->allCompanies();
            break;
        case BASE_PATH . 'addCompany':
            $companiesController->addCompany();
            break;
        case BASE_PATH . 'editCompany?id=' . @$_GET['id']:
            $companiesController->editCompany();
            break;
        case BASE_PATH . 'deleteCompany?id=' . @$_GET['id']:
            $companiesController->deleteCompany();
            break;
        case BASE_PATH . 'viewrate':
            $rateController->getAllRates();
            break;
        case BASE_PATH . 'viewratebystarnumber?star=' . @$_GET['star']:
            $rateController->getRatesByStarNum($_GET['star']);
            break;
        case BASE_PATH . 'viewratebyhotel?hotel_id=' . @$_GET['hotel_id']:
            $rateController->getRatesByHotelId($_GET['hotel_id']);
            break;
        case BASE_PATH . 'viewratebycustomer?customer_id=' . @$_GET['customer_id']:
            $rateController->getRatesByCustomerId($_GET['customer_id']);
            break;
        case BASE_PATH . 'addrate':
            $rateController->addRates();
            break;
        case BASE_PATH . 'editrate?id=' . @$_GET['id']:
            $rateController->editRates();
            break;
        case BASE_PATH . 'editratebyhotel?hotel_id=' . @$_GET['hotel_id']:
            $rateController->editRatesByHotelID();
            break;
        case BASE_PATH . 'editratebycustomer?customer_id=' . @$_GET['customer_id']:
            $rateController->editRatesByCustomerID();
            break;
        case BASE_PATH . 'deleterate?customer_id=' . @$_GET['customer_id'] . '&hotel_id=' . @$_GET['hotel_id']:
            $rateController->deleteRates();
            break;
        case BASE_PATH . 'deleteadmin?id=' . @$_GET['id']:
            $adminController->deleteAdmins($_GET['id']);
            break;
        case BASE_PATH . 'editadmin?id=' . @$_GET['id']:
            $adminController->updateAdmins($_GET['id']);
            break;
        case BASE_PATH . 'logout':
            $adminController->logout();
            return;
        case BASE_PATH . 'showallticket':
            $ticketController->getAllTicket();
            break;
        case BASE_PATH . 'showticketsbycompanyid?id=' . @$_GET['id']:
            $ticketController->getTicketsByCompanyId($_GET['id']);
            break;
        case BASE_PATH . 'showticketsbycityid?id=' . @$_GET['id']:
            $ticketController->getTicketsByCityId($_GET['id']);
            break;
        case BASE_PATH . 'addtickets':
            $ticketController->addTickets();
            break;
        case BASE_PATH . 'editticket?id=' . @$_GET['id']:
            $ticketController->editTickets();
            break;
        case BASE_PATH . 'showCustomers':
            $customerController->showCustomers();
            break;
        case BASE_PATH . 'addCustomer':
            $customerController->addCustomer();
            break;
        case BASE_PATH . 'deleteCustomer?id=' . $_GET['id']:
            $customerController->deleteCustomer($_GET['id']);
            break;
        case BASE_PATH . 'updateCustomer?id=' . @$_GET['id']:
            $customerController->updateCustomer($_GET['id']);
            break;
            case BASE_PATH . 'getCustomerByid?id=' . @$_GET['id']:
                $customerController->getCustomerByid($_GET['id']);
                break;
            case BASE_PATH . 'getCustomerByname?name=' . @$_GET['name']:
                $customerController->getCustomerByname($_GET['name']);
                break;
            case BASE_PATH . 'showCities':
                $citiesController->showCities();
                break;
            case BASE_PATH . 'addCity':
                $citiesController->addCity();
                break;
            case BASE_PATH . 'updateCity?id=' . @$_GET['id']:
                $citiesController->updateCity($_GET['id']);
                break;
            case BASE_PATH . 'deleteCity?id=' . $_GET['id']:
                $citiesController->deleteCity($_GET['id']);
                break;
            case BASE_PATH . 'getCityByid?id=' . @$_GET['id']:
                $citiesController->getCityByid($_GET['id']);
                break;
            case BASE_PATH . 'getCityByname?name=' . @$_GET['name']:
                $citiesController->getCityByname($_GET['name']);
                break;
        default:
            echo "action not found!!";
            break;
    }
}
