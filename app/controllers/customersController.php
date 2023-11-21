<?php
// namespace app\controllers;
require_once __DIR__ . '/../models/customersModel.php';
// use app\models\customersModel;
class customersController
{
    private $model;
    public function __construct($db)
    {
        $this->model = new customersModel($db);
    }
    public function showCustomers()
    {
        $customers = $this->model->getCustomer();
        if ($customers) {
            echo (json_encode(array('status' => 'true', 'data' => $customers)));
        } else {
            echo (json_encode(array('status' => 'false', 'message' => 'data wich entered is uncorrect')));
        }
    }
    public function addCustomer()
    {
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

                echo "Added successfully !";
            } else {
                echo "Failed to add customer !";
            }
            $result = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!($result)) {
                return TRUE;
            } else {
                return FALSE;
            }
            if (!isset($name)) {
                echo "enter customer name!";
                header('Location:' . BASE_PATH);
            }
            if (!isset($phone)) {
                echo "enter customer phone!";
                header('Location:' . BASE_PATH);
            }
            if (!isset($gender)) {
                echo "enter customer gender!";
                header('Location:' . BASE_PATH);
            }
            if (!isset($email)) {
                echo "enter customer emai!";
                header('Location:' . BASE_PATH);

                ucfirst($name);
            }
        }
    }
    // public function showCustomers(){
    //     if($this->model->getCustomer()){
    //         header('Location:' . BASE_PATH);
    //     }
    //     else{
    //         return FALSE;
    //     }
    // }
    public function deleteCustomer($id)
    {
        if ($this->model->deleteCustomer($id)) {
            echo "Customer deleted successfully!";
            header('Location:' . BASE_PATH);
        } else {
            echo "Failed to delete customer.";
        }
    }
    public function getCustomerByid($id)
    {
        $data = $this->model->getCustomer();
        if ($data) {
            header('Location:' . BASE_PATH);
            echo (json_encode(array('status' => 'true', 'data' => $data)));
        } else {
            echo (json_encode((array('status' => 'true', 'data' => "Filed get customer !"))));
        }
    }
    public function getCustomerByname($name)
    {
        $customers = $this->model->getCustomer();
        if ($customers) {
            header('Location:' . BASE_PATH);
            echo (json_encode(array('status' => 'true', 'data' => $customers)));
        } else {
            echo (json_encode(array('status' => 'false', 'message' => 'data wich entered is uncorrect')));
        }
    }

    public function updateCustomer($id)
    {
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
                echo "Customer updated successfully !";
                header('Location:' . BASE_PATH);
            } else {
                echo "Filed update !";
            }
        } else {
            $this->getCustomerByid($id);
        }
    }
    // public function searchCustomer($searchTerm){
    //     $customer=$this->model->searchCustomer($searchTerm);
    //     if($customer){
    //         header('Location:' . BASE_PATH);
    //     }
    //     else{
    //         return FALSE;
    //     }
    // }
}
