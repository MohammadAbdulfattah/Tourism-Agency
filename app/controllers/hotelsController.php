<?php
class HotelsController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new hotelsModel($db);
    }
    public function getHotelCity($city_id)
    {
        $cityName = $this->model->getHotelCity($city_id);
        if (!empty($cityName)) {
            return $cityName;
        } else {
            echo "No city found";
        }
    }
    public function allHotels()
    {
        if ($hotels = $this->model->getAllHotels()) {
            $data = array();
            foreach ($hotels as $hotel) {
                $name = $hotel['name'];
                $phone = $hotel['phone'];
                $cityName = $this->getHotelCity($hotel['city_id']);
                array_push($data, $name, $phone, $cityName);
            }
            echo json_encode(array('status' => 'true', 'data' => $data));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'no data'));
        }
    }
    public function getHotelName($id)
    {
        if ($hotels = $this->model->getHotelName($id)) {
            echo json_encode(array('status' => 'true', 'data' => $hotels));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'there is no hotel'));
        }
    }
    public function getHotelsBySpcInfo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conditions = array();
            foreach ($_POST as $key => $value) {
                $condition = "$key = '$value'";
                array_push($conditions, $condition);
            }
            if ($hotels = $this->model->getHotelBySpcInfo($conditions)) {
                $data = array();
                foreach ($hotels as $hotel) {
                    $name = $hotel['name'];
                    $phone = $hotel['phone'];
                    $cityName = $this->getHotelCity($hotel['city_id']);
                    array_push($data, $name, $phone, $cityName);
                }
                echo json_encode(array('status' => 'true', 'data' => $data));
            } else {
                echo json_encode(array('status' => 'false', 'message' => 'no data'));
            }
        } else {
            echo json_encode(array('status' => 'false', 'message' => ' wrong request method '));
        }
    }
    public function getHotelByID($id)
    {
        if ($hotels = $this->model->getHotelsByID($id)) {
            $data = array();
            foreach ($hotels as $hotel) {
                $name = $hotel['name'];
                $phone = $hotel['phone'];
                $cityName = $this->getHotelCity($hotel['city_id']);
                array_push($data, $name, $phone, $cityName);
            }
            echo json_encode(array('status' => 'true', 'data' => $data));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'no data'));
        }
    }
    public function getHotelsByPhone($phone)
    {
        if ($hotels = $this->model->getHotelByPhone($phone)) {
            $data = array();
            foreach ($hotels as $hotel) {
                $name = $hotel['name'];
                $phone = $hotel['phone'];
                $cityName = $this->getHotelCity($hotel['city_id']);
                array_push($data, $name, $phone, $cityName);
            }
            echo json_encode(array('status' => 'true', 'data' => $data));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'no data'));
        }
    }
    public function getHotelsByCity($cityName)
    {
        if ($hotels = $this->model->getHotelsByCity($cityName)) {
            $data = array();
            foreach ($hotels as $hotel) {
                $name = $hotel['name'];
                $phone = $hotel['phone'];
                $cityName = $this->getHotelCity($hotel['city_id']);
                array_push($data, $name, $phone, $cityName);
            }
            echo json_encode(array('status' => 'true', 'data' => $data));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'no hotels in this city'));
        }
    }
    public function getHotelByName($name)
    {
        if ($hotels = $this->model->getHotelByName($name)) {
            $data = array();
            foreach ($hotels as $hotel) {
                $name = $hotel['name'];
                $phone = $hotel['phone'];
                $cityName = $this->getHotelCity($hotel['city_id']);
                array_push($data, $name, $phone, $cityName);
            }
            echo json_encode(array('status' => 'true', 'data' => $data));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'there is some thing wrong'));
        }
    }
    public function addHotel()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $citiesID = array();
            $cities = $this->model->geAllCities();
            foreach ($cities as $city) {
                array_push($citiesID, $city['id']);
            }
            if (in_array($_POST['city_id'], $citiesID)) {
                $name = @$_POST['name'];
                $phone = @$_POST['phone'];
                $city_id = @$_POST['city_id'];
                if (!empty($name) && !empty($phone) && !empty($city_id)) {
                    $data = [
                        'name' => $name,
                        'phone' => $phone,
                        'city_id' => $city_id
                    ];
                    if ($this->model->addHotel($data)) {
                        echo json_encode(array('status' => 'true', 'message' => 'Hotel added successfully!'));
                    } else {
                        echo json_encode(array('status' => 'false', 'message' => 'Failed to add hotel.'));
                    }
                } else {
                    echo json_encode(array('status' => 'false', 'message' => 'please enter all the data'));
                }
            } else {
                echo json_encode(array('status' => 'false', 'message' => 'there is no city in this name'));
            }
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'Invalid request method'));
        }
    }
    public function editHotel()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $hotelInfo = $this->model->getHotelsByID($_GET['id']);
            $citiesID = array();
            $cities = $this->model->geAllCities();
            foreach ($cities as $city) {
                array_push($citiesID, $city['id']);
            }
            if (in_array(@$_POST['city_id'], $citiesID)) {
                $name = @$_POST['name'];
                $phone = @$_POST['phone'];
                $city_id = @$_POST['city_id'];
                if (!empty($name) && !empty($phone) && !empty($city_id)) {
                    $data = [
                        'name' => $name,
                        'phone' => $phone,
                        'city_id' => $city_id
                    ];
                    if (isset($_GET['id'])) {
                        if ($this->model->editHotelByID($data, $_GET['id'])) {
                            echo json_encode(array('status' => 'true', 'data' => 'Hotel info edited successfully'));
                        } else {
                            echo json_encode(array('status' => 'false', 'data' => 'Failed to edit hotel'));
                        }
                    } else {
                        echo json_encode(array('status' => 'false', 'data' => 'no ID provided to edit hotel !!'));
                    }
                } else {
                    echo json_encode(array('status' => 'false', 'data' => 'please enter all the data'));
                }
            } else {
                echo json_encode(array('status' => 'false', 'data' => 'there is no city in this name'));
            }
        } else {
            echo json_encode(array('status' => 'false', 'data' => 'Invalid request'));
        }
    }
    public function editHotelByName()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $citiesID = array();
            $cities = $this->model->geAllCities();
            foreach ($cities as $city) {
                array_push($citiesID, $city['id']);
            }
            if (in_array(@$_POST['city_id'], $citiesID)) {
                $name = @$_POST['name'];
                $phone = @$_POST['phone'];
                $city_id = @$_POST['city_id'];
                if (!empty($name) && !empty($phone) && !empty($city_id)) {
                    $data = [
                        'name' => $name,
                        'phone' => $phone,
                        'city_id' => $city_id
                    ];
                    if (isset($_GET['hotelName'])) {
                        if ($this->model->editHotelByName($data, $_GET['hotelName'])) {
                            echo json_encode(array('status' => 'true', 'data' => 'Hotel info edited successfully!'));
                        } else {
                            echo json_encode(array('status' => 'false', 'data' => 'Failed to edit hotel'));
                        }
                    } else {
                        echo json_encode(array('status' => 'false', 'data' => 'no hotel name provided to edit hotel !!'));
                    }
                } else {
                    echo json_encode(array('status' => 'false', 'data' => 'please enter all the data'));
                }
            } else {
                echo json_encode(array('status' => 'false', 'data' => 'there is no city in this name'));
            }
        } else {
            echo json_encode(array('status' => 'false', 'data' => 'Invalid request method'));
        }
    }
    public function editHotelByPhone()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $hotelInfo = $this->model->getHotelsByID($_GET['name']);
            $citiesID = array();
            $cities = $this->model->geAllCities();
            foreach ($cities as $city) {
                array_push($citiesID, $city['id']);
            }
            if (in_array(@$_POST['city_id'], $citiesID)) {
                $name = @$_POST['name'];
                $phone = @$_POST['phone'];
                $city_id = @$_POST['city_id'];
                if (!empty($name) && !empty($phone) && !empty($city_id)) {
                    $data = [
                        'name' => $name,
                        'phone' => $phone,
                        'city_id' => $city_id
                    ];
                    if (isset($_GET['phone'])) {
                        if ($this->model->editHotelByPhone($data, $_GET['phone'])) {
                            echo json_encode(array('status' => 'true', 'data' => 'Hotel info edited successfully!'));
                        } else {
                            echo json_encode(array('status' => 'false', 'data' => 'Failed to edit hotel'));
                        }
                    } else {
                        echo json_encode(array('status' => 'false', 'data' => 'no phone number provided to edit hotel !!'));
                    }
                } else {
                    echo json_encode(array('status' => 'false', 'data' => 'please enter all the data'));
                }
            } else {
                echo json_encode(array('status' => 'false', 'data' => 'there is no city in this nam'));
            }
        } else {
            echo json_encode(array('status' => 'false', 'data' => 'Invalid request method'));
        }
    }
    public function editHotelByCity()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $hotelInfo = $this->model->getHotelsByID($_GET['name']);
            $citiesID = array();
            $cities = $this->model->geAllCities();
            foreach ($cities as $city) {
                array_push($citiesID, $city['id']);
            }
            if (in_array(@$_POST['city_id'], $citiesID)) {
                $name = @$_POST['name'];
                $phone = @$_POST['phone'];
                $city_id = @$_POST['city_id'];
                if (!empty($name) && !empty($phone) && !empty($city_id)) {
                    $data = [
                        'name' => $name,
                        'phone' => $phone,
                        'city_id' => $city_id
                    ];
                    if (isset($_GET['cityName'])) {
                        if ($this->model->editHotelByCity($data, $_GET['cityName'])) {
                            echo json_encode(array('status' => 'true', 'data' => 'Hotel info edited successfully!'));
                        } else {
                            echo json_encode(array('status' => 'false', 'data' => 'Failed to edit hotel'));
                        }
                    } else {
                        echo json_encode(array('status' => 'false', 'data' => 'no City name provided to edit hotel !!'));
                    }
                } else {
                    echo json_encode(array('status' => 'false', 'data' => 'please enter all the data'));
                }
            } else {
                echo json_encode(array('status' => 'false', 'data' => 'there is no city in this name'));
            }
        } else {
            echo json_encode(array('status' => 'false', 'data' => 'Invalid request method'));
        }
    }
    public function deleteHotel()
    {
        if (isset($_GET['id'])) {
            $hotels = $this->model->getAllHotels();
            $allID = array();
            foreach ($hotels as $hotel) {
                array_push($allID, $hotel['id']);
            }
            if (in_array($_GET['id'], $allID)) {
                $this->model->deleteHotel($_GET['id']);
                echo json_encode(array('status' => 'true', 'data' => 'Hotel data has been deleted successfully'));
            } else {
                echo json_encode(array('status' => 'false', 'data' => 'some thing went wrong!!'));
            }
        } else {
            echo json_encode(array('status' => 'false', 'data' => 'no ID provided to delete hotel !!'));
        }
    }
}
