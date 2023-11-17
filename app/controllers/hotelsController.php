<?php
class HotelsController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }
    public function index()
    {
        return $this->model->getAllHotels();
    }
    public function getHotelsBySpcInfo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conditions = array();
            foreach ($_POST as $key => $value) {
                $condition = "$key = $value";
                array_push($conditions, $condition);
            }
            return $this->model->getHotelBySpcInfo($conditions);
        }
    }
    public function getHotelByID($id)
    {
        return $this->model->getHotelsByID($id);
    }
    public function getHotelsByPhone($phone)
    {
        $bookings = $this->model->getHotelByPhone($phone);
    }
    public function getHotelsByCity($cityName)
    {
        return $this->model->getHotelsByCity($cityName);
    }
    public function getHotelByName($name)
    {
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
                echo "Hotel added successfully!";
                // header("REFRESH:0 ; URL=".BASE_PATH);
            } else {
                echo "Failed to add hotel.";
            }
        }
    }
    public function editHotel()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $hotelInfo = $this->model->getHotelsByID($_GET['id']);
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $city_id = $_POST['city_id'];
            $data = [
                'name' => $name,
                'phone' => $phone,
                'city_id' => $city_id
            ];
            if ($this->model->editHotelByID($data, $_GET['id'])) {
                echo "Hotel info edited successfully!";
                // header("REFRESH:0 ; URL=".BASE_PATH);

            } else {
                echo "Failed to edit hotel.";
            }
        }
    }
    public function editHotelByName()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $hotelInfo = $this->model->getHotelsByID($_GET['name']);
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $city_id = $_POST['city_id'];
            $data = [
                'name' => $name,
                'phone' => $phone,
                'city_id' => $city_id
            ];
            if ($this->model->editHotelByName($data, $_GET['name'])) {
                echo "Hotel info edited successfully!";
                // header("REFRESH:0 ; URL=".BASE_PATH);

            } else {
                echo "Failed to edit hotel.";
            }
        }
    }
    public function editHotelByPhone()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $hotelInfo = $this->model->getHotelsByID($_GET['name']);
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $city_id = $_POST['city_id'];
            $data = [
                'name' => $name,
                'phone' => $phone,
                'city_id' => $city_id
            ];
            var_dump($_GET);
            if ($this->model->editHotelByPhone($data, $_GET['phone'])) {
                echo "Hotel info edited successfully!";
                // header("REFRESH:0 ; URL=".BASE_PATH);

            } else {
                echo "Failed to edit hotel.";
            }
        }
    }
    public function editHotelByCity()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $hotelInfo = $this->model->getHotelsByID($_GET['name']);
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $city_id = $_POST['city_id'];
            $data = [
                'name' => $name,
                'phone' => $phone,
                'city_id' => $city_id
            ];
            var_dump($_GET);
            if ($this->model->editHotelByCity($data, $_GET['cityName'])) {
                echo "Hotel info edited successfully!";
                // header("REFRESH:0 ; URL=".BASE_PATH);

            } else {
                echo "Failed to edit hotel.";
            }
        }
    }
    public function deleteHotel($id)
    {
        $this->model->deleteHotel($_GET['id']);
    }
    public function deleteHotelByCity($cityName)
    {

        $this->model->deleteHotelByItsCity($_GET['cityName']);
    }
}
