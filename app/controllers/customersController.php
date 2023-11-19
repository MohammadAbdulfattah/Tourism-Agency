<?php
namespace app\controllers;
require_once __DIR__.'/../models/customersModel.php';
use app\models\customersModel;
Class customersController{
    private $model;
    public function __construct($db){
        $this->model = new customersModel($db);
    }
    public function index(){
        $customers=$this->model->getCustomer();
    }
    public function addCustomer(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $name = $_POST ['name'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];

            $data = [
                'name' => $name,
                'phone' => $phone ,
                'gender' => $gender,
                'email' => $email,
            ];
            if($this->model->addCustomer($data)){
                header('Location:' . BASE_PATH);
                echo "Added successfully !";
            }
            else{
                echo "Failed to add customer !";
            } 
            $result = filter_var($email , FILTER_VALIDATE_EMAIL);
            if(!($result)){
                return TRUE;
            }
            else{
                return FALSE;
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
    // public function deleteCustomer($id){
    //     if($this->model->deleteCustomer($id))
    //     {
    //         echo "Customer deleted successfully!";
    //         header('Location:' . BASE_PATH);
    //     }
    //     else {
    //         echo "Failed to delete customer.";
    //     }
    // }
    // public function getCustomerByid($id) {
    //     if($this->model->getCustomer($id)){
    //         header('Location:' . BASE_PATH);        }
    //     else{
    //         return FALSE;
    //     }
    // }
    // // public function getCustomerByname($name){
    // //     $customers = $this->model->getCustomer($name);
    // //     if($customers){
    // //         header('Location:' . BASE_PATH);
    // //         var_dump($customers);
    // //     }
    // //     else{
    // //         return FALSE;
    // //     }
    // // }
    // public function updateCustomer($id) {
    //     if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //         $name = $_POST ['name'];
    //         $phone = $_POST['phone'];
    //         $gender = $_POST['gender'];
    //         $email = $_POST['email'];

    //         $data = [
    //             'name' => $name,
    //             'phone' => $phone ,
    //             'gender' => $gender,
    //             'email' => $email,
    //         ];
    //         if($this->model->updateCustomer($id,$data)){
    //             echo "Customer updated successfully !";
              
    //            header('Location:' . BASE_PATH);
    //         }
    //         else{
    //             echo "Filed update !";
    //         }
    //     }
    //     else{
    //         $this->getCustomerByid($id);
    //     }
    // }
    // public function searchCustomer($searchTerm){
    //     $customer=$this->model->searchCustomer($searchTerm);
    //     if($customer){
    //         header('Location:' . BASE_PATH);
    //     }
    //     else{
    //         return FALSE;
    //     }
    // }
    // // public function editCustomer($id){
    // //     $customers=$this->model->getCustomerByid($id);
    // //     if($customers){
    // //         return True;
    // //     }
    // //     else{
    // //         return FALSE;
    // //     }
    // // }
}