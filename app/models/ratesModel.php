<?php
class RatesModel
{
    public $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    //Methods to Get Rate
    public function getAllRates()
    {
        return $this->db->get('rate');
    }
    public function getRateByID($id)
    {
        $this->db->Where('id', $id);
        return $this->db->get('rate');
    }
    public function getRateByStarNum($star)
    {
        $this->db->Where('star', $star);
        return $this->db->get('rate');
    }
    public function getRateByHotelId($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->get('rate');
    }
    public function getRateByCustomerId($customer_id)
    {
        $this->db->where('customer_id', $customer_id);
        return $this->db->get('rate');
    }
    //Method to Add Rate
    public function addRate($data)
    {
        return $this->db->insert('rate', $data);
    }
    //Methods to Edit Rate
    public function editRateByID($data, $id)
    {
        $this->db->Where('id', $id);
        return $this->db->update('rate', $data);
    }
    public function editRateByHotelID($data, $hotel_id)
    {
        $this->db->Where('hotel_id', $hotel_id);
        return $this->db->update('rate', $data);
    }
    public function editRateByCustomerID($data, $customer_id)
    {
        $this->db->Where('customer_id', $customer_id);
        return $this->db->update('rate', $data);
    }
    //Method to Delete Rate
    public function deleteRate($customer_id, $hotel_id)
    {
        $this->db->Where('customer_id', $customer_id);
        $this->db->Where('hotel_id', $hotel_id);
        $result = $this->db->get('rate');
        if ($result) {
            $this->db->Where('customer_id', $customer_id);
            $this->db->Where('hotel_id', $hotel_id);
            $this->db->delete('rate');
            return true;
        }
        return false;   
    }
}
