<?php
// namespace app\controllers;
// use app\models\citiesModel;
Class citiesController{
    private $model;
    public function __contsruct($db){
        $this->model=new citiesModel($db);
    }
    public function showCities(){
        $city=$this->model->getCity();
        header('Location' . BASE_PATH);
        if($city){
            echo (json_encode(array('status' => 'true' , 'data' => $city)));
        }
        else{
            echo (json_encode(array('status' => 'false' , 'data' => "Filed get city !")));
        }
    }
    public function addCity(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $city = $_POST['name'];
            $country = $_POST['country'];

            $data = ['name' => $city ,'country' => $country];
            $this->model->addCity($data);
            /*if(){
                //header('Location:' . BASE_PATH);
                echo "Added successfully !";
            }
            else{
                echo "Failed to add city !";
            }
            if(!(isset($city))){
                echo "Enter city name !";
                header("Location" . BASE_PATH);
            }
            if(!isset($country)){
                echo "Enter country name !";
                header("Location" . BASE_PATH);
            }
            ucfirst($city);
            ucfirst($country);*/
        }  
    }
    public function getCityByid($id){
        $city = $this->model->getCity();
        if($city){
            header("Location" . BASE_PATH);
            echo (json_encode(array('status' => 'true' , 'data' => $city)));
        }
        else{
            echo(json_encode(array('status' => 'false' , 'data' => 'filed get city')));
        }
    }
    
    public function getCityByname($name){
        $cities = $this->model->getCity();
        if($cities){
            header('Location:' . BASE_PATH);
            echo (json_encode(array('status' => 'true' , 'data' => $cities)));
        }
        else{
            echo (json_encode(array('status' => 'false' , 'message' => 'filed get city')));
        }
    } 
    public function updateCity($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = $_POST['name'];
            $country = $_POST['country'];

            $data = ['name' => $name , 'country' => $country];

            if($this->model->updateCity($id,$data)){
                echo " City updated succssefully !";
                header('Location:' . BASE_PATH);
            }
            else{
                echo "Filed update !";
            }
        }
        else{
            $this->getCityByid($id);
        }
    }
    public function deleteCity($id){
        if($this->model->deleteCity($id))
        {
            echo "City deleted successfully!";
            header('Location:' . BASE_PATH);
        }
        else {
            echo "Failed to delete city";
        }
    } 
    // public function searchCity($condition){
    //     $city=$this->model->searchCity($condition);
    //     if($city){
    //         echo $city;
    //         return TRUE;
    //     }
    //     else{
    //         return FALSE;
    //     }
    // }
}