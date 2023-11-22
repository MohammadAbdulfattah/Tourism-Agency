<?php

class RatesController
{
    private $model;
    private $customer;
    private $hotel;

    public function __construct($db)
    {
        $this->model = new RatesModel($db);
        $this->customer = new customersModel($db);
        $this->hotel = new HotelsModel($db);
    }
    public function getAllRates()
    {
        $result = $this->model->getAllRates();
        if ($result) {
            $information = array();
            foreach ($result as $res) {
                foreach ($res as $key => $value) {
                    if ($key == "customer_id") {
                        $customer_name = $this->customer->getCustomerByid($value);
                        foreach ($customer_name as $key2 => $value2) {
                                if ($key2 == 'name') {
                                    array_push($information, $key2, $value2);
                                }
                            }
                    }
                    if ($key == "hotel_id") {
                        $hotel_name = $this->hotel->getHotelsByID($value);
                        foreach ($hotel_name as $hot) {
                            
                            foreach ($hot as $key3 => $value3) {
                                if ($key3 == 'name') {
                                    array_push($information, $key3, $value3);
                                }
                            }
                        }
                    }
                    if ($key == 'comment' || $key == 'star') {
                        array_push($information, $key, $value);
                    }
                }
            echo json_encode(array('status' => 'true', 'data' => $information));
            }
        } else {
            echo json_encode(array('status' => 'false', 'messege' => 'some thing wrong'));
        }
    }
    public function getRatesByStarNum($star)
    {
        $result = $this->model->getrateByStarNum($star);
        $information = array();
        if ($result) {
            foreach ($result as $res) {
                foreach ($res as $key => $value) {
                    if ($key == "hotel_id") {
                        $hotel_name = $this->hotel->getHotelsByID($value);
                        foreach ($hotel_name as $hot) {
                            foreach ($hot as $key3 => $value3) {
                                if ($key3 == 'name') {
                                    array_push($information, $key3, $value3);
                                }
                            }
                        }
                    }
                    if ($key == 'comment') {
                        array_push($information, $key, $value);
                    }
                }
            }
            echo json_encode(array('status' => 'true', 'data' => $information));
        } else {
            echo json_encode(array('status' => 'false', 'messege' => 'There Is No Hotel With This Rating'));
        }
    }
    public function getRatesByHotelId($hotel_id)
    {
        $result = $this->model->getRateByHotelId($hotel_id);
        $information = array();
        if ($result) {
            foreach ($result as $res) {
                foreach ($res as $key => $value) {
                    if ($key == 'star' || $key == 'comment') {
                        array_push($information, $key, $value);
                    }
                }
            }
            echo json_encode(array('status' => 'true', 'data' => $information));
        } else {
            echo json_encode(array('status' => 'false', 'messege' => 'some thing wrong'));
        }
    }
    public function getRatesByCustomerId($customer_id)
    {
        $result = $this->model->getRateByCustomerId($customer_id);
        $information = array();
        if ($result) {
            foreach ($result as $res) {
                foreach ($res as $key => $value) {
                    if ($key == 'star' || $key == 'comment') {
                        array_push($information, $key, $value);
                    }
                }
            }
            echo json_encode(array('status' => 'true', 'data' => $information));
        } else {
            echo json_encode(array('status' => 'false', 'messege' => 'some thing wrong'));
        }
    }
    public function addRates()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_id = @$_POST['customer_id'];
            $hotel_id = @$_POST['hotel_id'];
            $comment = @$_POST['comment'];
            $star = @$_POST['star'];
            if(($star) > 5){
                echo json_encode(array('status' => 'false', 'messege' => 'Rate Star Must be Less than 5'));
                return;
            }
            $result = $this->model->getAllRates();
            foreach ($result as $res) {
                foreach ($res as $key => $value) {
                    if ($key == 'customer_id' && $value == $customer_id) {
                        foreach ($res as $key2 => $value2) {
                            if($key2 == 'hotel_id' && $value2 == $hotel_id){
                                echo json_encode(array('status' => 'false', 'messege' => 'The Customer is already rate this hotel.'));
                                return;
                            }
                        }
                    }
                }
            }
            $data = [
                'customer_id' => $customer_id,
                'hotel_id' => $hotel_id,
                'comment' => $comment,
                'star' => $star
            ];
            if ($this->model->addRate($data)) {
                echo json_encode(array('status' => 'true', 'messege' => 'Rate added successfully!'));
            } else {
                echo json_encode(array('status' => 'false', 'messege' => 'Failed to add Rate.'));
            }
        }
    }
    public function editRates()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comment = $_POST['comment'];
            $star = $_POST['star'];
            if(($star + 0) > 5){
                echo json_encode(array('status' => 'false', 'messege' => 'Rate Star Must be Less than 5'));
                return;
            }
            $data = [
                'comment' => $comment,
                'star' => $star
            ];
            if ($this->model->editRateByID($data, $_GET['id'])) {
                echo json_encode(array('status' => 'true', 'messege' => 'Rate info edited successfully!'));
            } else {
                echo json_encode(array('status' => 'false', 'messege' => 'Failed to edit Rate.'));
            }
        }
    }
    public function editRatesByHotelID()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comment = $_POST['comment'];
            $star = $_POST['star'];
            if(($star + 0) > 5){
                echo json_encode(array('status' => 'false', 'messege' => 'Rate Star Must be Less than 5'));
                return;
            }
            $data = [
                'comment' => $comment,
                'star' => $star
            ];
            if ($this->model->editRateByHotelID($data, $_GET['hotel_id'])) {
                echo json_encode(array('status' => 'true', 'messege' => 'Rate info edited successfully!'));
            } else {
                echo json_encode(array('status' => 'false', 'messege' => 'Failed to edit Rate.'));
            }
        }
    }
    public function editRatesByCustomerID()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comment = $_POST['comment'];
            $star = $_POST['star'];
            if(($star + 0) > 5){
                echo json_encode(array('status' => 'false', 'messege' => 'Rate Star Must be Less than 5'));
                return;
            }
            $data = [
                'comment' => $comment,
                'star' => $star
            ];
            if ($this->model->editRateByCustomerID($data, $_GET['customer_id'])) {
                echo json_encode(array('status' => 'true', 'messege' => 'Rate info edited successfully!'));
            } else {
                echo json_encode(array('status' => 'false', 'messege' => 'Failed to edit Rate.'));
            }
        }
    }
    public function deleteRates()
    {
        if ($this->model->deleteRate($_GET['customer_id'], $_GET['hotel_id'])) {
            echo json_encode(array('status' => 'true', 'messege' => 'Delete Done successfully!'));
        } else {
            echo json_encode(array('status' => 'false', 'messege' => 'Failed to Delete Rate.'));
        }
    }
}
