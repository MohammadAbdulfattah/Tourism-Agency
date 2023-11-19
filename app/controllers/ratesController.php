<?php
require __DIR__ . '/../models/ratesModel.php';
require __DIR__ . '/../models/customersModel.php'; 
require __DIR__ . '/../models/hotelsModel.php'; 

class RatesController{
    private $model;
    private $customer;
    private $hotel;

    public function __construct($db){
        $this->model = new RatesModel($db);
        $this->customer = new CustomerModel($db);
        $this->hotel = new HotelsModel($db);
    }
    public function index(){
        $result = $this->model->getAllRates();
        foreach ($result as $res) {
            foreach ($res as $key => $value) {
                if ($key == "customer_id"){
                    $customer_name = $this->customer->getCustomerByid($value);
                    foreach ($customer_name as $cust) {
                        foreach ($cust as $key2 => $value2) {
                            if($key2 == 'name'){
                                echo $value2 ;
                            }
                        }
                    }
                }
                if ($key == "hotel_id"){
                    $hotel_name = $this->hotel->getHotelsByID($value);
                    foreach ($hotel_name as $hot) {
                        foreach ($hot as $key3 => $value3) {
                            if($key3 == 'name'){
                                echo $value3 ;
                            }
                        }
                    }
                }
                if ($key == 'comment' || $key == 'star') {
                    echo $value;
                }
                echo "<br>";
            }
        }
    }
    public function getRatesByStarNum($star) {
        $result = $this->model->getrateByStarNum($star);
        foreach ($result as $res) {
            foreach ($res as $key => $value) {
                if ($key == 'hotel_id' || $key == 'comment') {
                    echo $value;
                }
            }
        }
    }
    public function getRatesByHotelId($hotel_id) {
        $result = $this->model->getRateByHotelId($hotel_id);
        foreach ($result as $res) {
            foreach ($res as $key => $value) {
                if ($key == 'star' || $key == 'comment') {
                    echo $value;
                }
            }
        }
    }
    public function getRatesByCustomerId($customer_id) {
        $result = $this->model->getRateByCustomerId($customer_id);
        foreach ($result as $res) {
            foreach ($res as $key => $value) {
                if ($key == 'star' || $key == 'comment') {
                    echo $value;
                }
            }
        }
    }
    public function addRates() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_id = $_POST['customer_id'];
            $hotel_id = $_POST['hotel_id'];
            $comment = $_POST['comment'];
            $star = $_POST['star'];
            $data = [
                'customer_id' => $customer_id,
                'hotel_id' => $hotel_id,
                'comment'=> $comment,
                'star' => $star
            ];
            if ($this->model->addRate($data)) {
                echo "Rate added successfully!";
                // header("REFRESH:0 ; URL=".BASE_PATH);
            } else {
                echo "Failed to add Rate.";
            }
        }
    }
    public function editRates() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comment = $_POST['comment'];
            $star = $_POST['star'];
            $data = [
                'comment' => $comment,
                'star' => $star
            ];
            if ($this->model->editRateByID($data, $_GET['id'])) {
                echo "Rate info edited successfully!";

            } else {
                echo "Failed to edit Rate.";
            }
        }
    }
    public function editRatesByHotelID(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comment = $_POST['comment'];
            $star = $_POST['star'];
            $data = [
                'comment' => $comment,
                'star' => $star
            ];
            if ($this->model->editRateByHotelID($data, $_GET['hotel_id'])) {
                echo "Rate info edited successfully!";
                // header("REFRESH:0 ; URL=".BASE_PATH);

            } else {
                echo "Failed to edit Rate.";
            }
        }
    }
    public function editRatesByCustomerID(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $star = $_POST['star'];
            $comment = $_POST['comment'];
            $data = [
                'comment' => $comment,
                'star' => $star
            ];
            if ($this->model->editRateByCustomerID($data, $_GET['customer_id'])) {
                echo "Rate info edited successfully!";
                // header("REFRESH:0 ; URL=".BASE_PATH);

            } else {
                echo "Failed to edit Rate.";
            }
        }
    }
    public function deleteRates(){
        $this->model->deleteRate($_GET['customer_id'],$_GET['hotel_id']);
    }
}
?>