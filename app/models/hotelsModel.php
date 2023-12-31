<?php
class HotelsModel
{
    public $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getHotelCity($city_id)
    {
        $this->db->Where('id', $city_id);
        $cities = $this->db->get('cities');
        foreach ($cities as $city) {
            $cityName = $city['name'];
            return $cityName;
        }
    }
    public function geAllCities()
    {
        $cities = $this->db->get('cities');
        return $cities;
    }
    public function getAllHotels()
    {
        return $this->db->get('hotels');
    }
    public function getHotelName($id)
    {
        return $this->db->rawQuery("SELECT name FROM hotels WHERE id = $id");
    }
    public function getHotelBySpcInfo($conditions = array())
    {
        #condition : column = condition;
        $sql = '';
        if (!empty($conditions)) {
            for ($i = 0; $i < count($conditions); $i++) {
                $sql .= $conditions[$i];
                for ($j = 0; $j < 1; $j++) {
                    $sql .= ' AND ';
                }
            }
            $sql = rtrim($sql, 'AND ');
            $query = "SELECT * FROM hotels WHERE " . $sql;
            return $this->db->rawQuery($query);
        }
    }
    public function getHotelsByID($id)
    {
        $this->db->Where('id', $id);
        return $this->db->get('hotels');
    }
    public function getHotelByName($name)
    {
        $this->db->Where('name', $name);
        return $this->db->get('hotels');
    }
    public function getHotelByPhone($phone)
    {
        $this->db->Where('phone', $phone);
        return $this->db->get('hotels');
    }
    public function getHotelsByCity($cityName)
    {
        $cities = $this->db->get('cities');
        foreach ($cities as $city) {
            if ($cityName == $city['name']) {
                $city_id = $city['id'];
            }
        }
        $this->db->Where('city_id', $city_id);
        return $this->db->get('hotels');
    }
    public function addHotel($data)
    {
        return $this->db->insert('hotels', $data);
    }
    public function editHotelByID($data, $id)
    {
        $this->db->Where('id', $id);
        return $this->db->update('hotels', $data);
    }
    public function editHotelByName($data, $name)
    {
        $this->db->Where('name', $name);
        return $this->db->update('hotels', $data);
    }
    public function editHotelByPhone($data, $phone)
    {
        $this->db->Where('phone', $phone);
        return $this->db->update('hotels', $data);
    }
    public function editHotelByCity($data, $cityName)
    {
        $cities = $this->db->get('cities');
        foreach ($cities as $city) {
            if ($cityName == $city['name']) {
                $city_id = $city['id'];
            }
        }
        $this->db->Where('city_id', $city_id);
        return $this->db->update('hotels', $data);
    }
    public function deleteHotel($id)
    {
        $this->db->Where('id', $id);
        $this->db->delete('hotels');
    }
    public function deleteHotelByItsCity($cityName)
    {
        $cities = $this->db->get('cities');
        foreach ($cities as $city) {
            if ($cityName == $city['name']) {
                $city_id = $city['id'];
            } else {
                echo json_encode(array('status' => 'false', 'message' => 'there is no city in this name'));
            }
        }
        $this->db->Where('city_id', $city_id);
        $this->db->delete('hotels');
    }
}
