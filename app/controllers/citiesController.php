<?php
require_once __DIR__.'/../models/citiesModel.php';
Class citiesController{
    private $model;
    public function __construct($db)
    {
        $this->model=new citiesModel($db);
    }
    public function showCities(){
        $city=$this->model->getCity();
        header('Location' . BASE_PATH);
        if($city){
            echo (json_encode(array('status' => 'true' , 'data' => $city)));
        }
        else{
            echo (json_encode(array('status' => 'false' , 'message' => "Filed get city !")));
        }
    }
    public function addCity(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $city = $_POST['name'];
            $country = $_POST['country'];

            $data = ['name' => $city ,'country' => $country];
            $this->model->addCity($data);
          
            if($data){
                if(empty($city)){
                    echo (json_encode(array('status' => 'false' , 'message' => 'enter city name!')));
                }
                elseif(empty($country)){
                    echo (json_encode(array('status' => 'false' , 'message' => 'enter country!')));
                }
                else{
                echo (json_encode(array('status' => 'true' , 'message' => 'added successfully!')));
                ucfirst($city);
                ucfirst($country);
                }
            }
            else{
                echo "Failed to add city !";
            }
           
        }  
    }
    public function getCityByid($id){
        $city = $this->model->getCityByid($id);
        if($city){
            echo (json_encode(array('status' => 'true' , 'data' => $city)));
        }
        else{
            echo(json_encode(array('status' => 'false' , 'message' => 'filed get city')));
        }
    }
    
    public function getCityByname($name){
        $cities = $this->model->getCityByname($name);
        if($cities){
            echo (json_encode(array('status' => 'true' , 'data' => $cities)));
        }
        else{
            echo (json_encode(array('status' => 'false' , 'message' => 'filed get city')));
        }
    } 
    public function updateCity($id){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name = $_POST['name'];
            $country = $_POST['country'];

            $data = ['name' => $name , 'country' => $country];

            if($this->model->updateCity($id,$data)){
                echo json_encode(array('status' => 'true' , 'data' => $data));
            }
            else{
                echo json_encode(array('status' => 'false' , 'message' => 'something went wrong!'));
            }
        }
    }
    public function deleteCity($id){
        if($this->model->deleteCity($id))
        {
            echo json_encode(array('status' => 'true' , 'message' => 'deleted successfully!'));
        }
        else {
            echo json_encode(array('status' => 'false' , 'message' => 'something went wrong !'));
        }
    } 

}