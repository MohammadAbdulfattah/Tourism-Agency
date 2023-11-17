<?php
class HotelsController{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }
    public function index(){
        $bookings = $this->model->getAllHotels();
    }
    public function getHotelByID($id){
        $bookings = $this->model->getHotelByID($id);
    }
    public function getHotelsByPhone($phone){
        $bookings = $this->model->getHotelByPhone($phone);
    }
    public function getHotelsByCity($cityName){
        $bookings = $this->model->getHotelsByCity($cityName);
    }
    public function getHotelByName($name){
        $bookings = $this->model->getHotelByName($name);
    }
    public function addHotel()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $city_id = $_POST['city_id'];
            $data = [
                'name' => $name,
                'phone' => $phone,
                'city_id' => $city_id
            ];

            if ($this->model->addHotel($data)) {
                echo "User added successfully!";
                // header("REFRESH:0 ; URL=".BASE_PATH);
            } else {
                echo "Failed to add user.";
            }

        }
    }
}