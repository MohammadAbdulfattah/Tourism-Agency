<?php
require __DIR__ . '/../models/ratesModel.php';


class RatesController{
    private $model;

    public function __construct($db){
        $this->model = new RatesModel($db);
    }
    public function index(){
        return $this->model->getAllRates();
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