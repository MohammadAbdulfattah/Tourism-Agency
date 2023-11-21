<?php
require_once __DIR__ . '/../models/customersModel.php';
class customersController
{
    private $model;
    public function __construct($db){
        $this->model = new customersModel($db);
    }
    public function showCustomers(){
        $customers = $this->model->getCustomer();
        if ($customers){
            echo (json_encode(array('status' => 'true', 'data' => $customers)));
        } else {
            echo (json_encode(array('status' => 'false', 'message' => 'data wich entered is uncorrect')));
        }
    }
    public function addCustomer(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];

            $data = [
                'name' => $name,
                'phone' => $phone,
                'gender' => $gender,
                'email' => $email,
            ];
            if ($this->model->addCustomer($data)) {
                if (empty($name)) {
                    echo json_encode(array('status' => 'false' , 'message' => 'enter customer name!'));
                }
                elseif (empty($phone)) {
                    echo json_encode(array('status' => 'false' , 'message' => 'enter customer phone!'));
                }
                elseif (empty($gender)) {
                    echo json_encode(array('status' => 'false' , 'message' => 'enter customer gender!'));
                }
                elseif (empty($email)) {
                    echo json_encode(array('status' => 'false' , 'message' => 'enter customer email!'));
                }
                elseif(!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
                echo json_encode(array('status' => 'false' , 'message' => 'uncorrect email!'));
                } 
                else{
                    echo "Added successfully !";
                }
            }
                else {
                echo "Failed to add customer !";
            }
        }
    }
    public function deleteCustomer($id){
        if ($this->model->deleteCustomer($id)) {
            echo json_encode(array('status' => 'true' , 'message' => 'customer deleted successfully!'));

        } else {
            echo json_encode(array('status' => 'false' , 'message' => 'something went wrong!'));
        }
    }
    public function getCustomerByid($id){
        $data = $this->model->getCustomerByid($id);
        if ($data) {
            echo (json_encode(array('status' => 'true', 'data' => $data)));
        } else {
            echo (json_encode((array('status' => 'true', 'message' => "Filed get customer !"))));
        }
    }
    public function getCustomerByname($name){
        $customers = $this->model->getCustomerByname($name);
        if ($customers) {
            echo (json_encode(array('status' => 'true', 'data' => $customers)));
        } else {
            echo (json_encode(array('status' => 'false', 'message' => 'data wich entered is uncorrect')));
        }
    }

    public function updateCustomer($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];

            $data = [
                'name' => $name,
                'phone' => $phone,
                'gender' => $gender,
                'email' => $email,
            ];
            if ($this->model->updateCustomer($id, $data)) {
                echo json_encode(array('status' => 'true' , 'message' => 'customer updated successfully!'));
            } 
            else {
                echo json_encode(array('status' => 'false' , 'message' => 'something went wrong!'));
            }
        }
    }

}
