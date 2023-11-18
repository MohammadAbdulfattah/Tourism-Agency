<?php
namespace app\controllers;
require_once __DIR__.'../models/CityModel';
use app\models\citiesModel;
Class citiesController{
    private $model;
    public function __contsruct($db){
        $this->model=new citiesModel($db);
    }
    public function index(){
        $city=$this->model->getCity();
    }
    public function addCity(){
        if($_SERVER['REQUEST_METHOD']){
            $name = $_POST['name'];
            $country = $_POST['country'];

            $data = ['name' => $name ,'country' => $country];

            if($this->model->addCity($data)){
                header('Location:' . BASE_PATH);
                echo "Added successfully !";
            }
            else{
                echo "Failed to add city !";
            }
            ucfirst($name);
            ucfirst($country);
        }  
    }
    public function getCityByid($id){
        $city = $this->model->getCityByid($id);
        if($city){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    public function updateCity($id){
        if($_SERVER['REQUEST_MATHOD'] == 'POST'){
            $name = $_POST['name'];
            $country = $_POST['country'];

            $data = ['name' => $name , 'country' => $country];

            if($this->model->updateCity($id,$data)){
                echo " City updated succssefully !";
                header('Location:' . BASE_PATH);
            }
            else{
                echo "failed update !";
            }
        }
        else{
            $this->getCityByid($id);
        }
    }
    public function searchCity($condition){
        $city=$this->model->searchCity($condition);
        if($city){
            echo $city;
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
}