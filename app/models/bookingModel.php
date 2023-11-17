<?php
class BookingModel
{
    public $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getAllBooking()
    {
        return $this->db->get('booking');
    }
    public function getBookingByID($id){
        $this->db->Where('id', $id);
        return $this->db->get('booking');
    }
    public function getBookingByHotel($hotelName){
        $hotels = $this->db->get('hotels');
        foreach ($hotels as $hotel) {
            if($hotelName==$hotel['name']){
                $hotel_id = $hotel['id'];
            }
        }
        $this->db->where("hotel_id",$hotel_id);
        return $this->db->get('booking');
    }
    public function getBookingByCustomer($customerName){
        $customers = $this->db->get('customers');
        foreach ($customers as $customer) {
            if($customerName==$customer['name']){
                $customer_id = $customer['id'];
            }
        }
        $this->db->where("customer_id",$customer_id);
        return $this->db->get('booking');
    }
    public function getBookingByDate($date){
        $this->db->where("date",$date);
        return $this->db->get('booking');
    }
    public function getBookingByTicket($ticket_id){
        $this->db->where("ticket_id",$ticket_id);
        return $this->db->get('booking');
    }
    public function addBooking($data)
    {
        return $this->db->insert('booking', $data);
    }
    public function editBooking($data,$id)
    {
        $this->db->Where('id',$id);
        return $this->db->update('booking', $data);
    }
    public function editBookingByCustomer($data,$customerName)
    {
        $customers = $this->db->get('customers');
        foreach ($customers as $customer) {
            if($customerName==$customer['name']){
                $customer_id = $customer['id'];
            }
        }
        $this->db->Where('customer_id',$customer_id);
        return $this->db->update('booking', $data);
    }
    public function editBookingByTicket($data,$ticket_id)
    {
        $this->db->Where('ticket_id',$ticket_id);
        return $this->db->update('booking', $data);
    }
    public function editBookingHotel($data,$hotelName)
    {
        $hotels = $this->db->get('hotels');
        foreach ($hotels as $hotel) {
            if($hotelName==$hotel['name']){
                $hotel_id = $hotel['id'];
            }
        }
        $this->db->Where('hotel_id',$hotel_id);
        return $this->db->update('booking', $data);
    }
    public function deleteBookingByID($id)
    {
        $this->db->Where('id', $id);
        $this->db->delete('booking');
    }
    public function deleteBookingByDate($date)
    {
        $this->db->Where('date', $date);
        $this->db->delete('booking');
    }
    public function deleteBookingByCustomer($customerName)
    {
        $customers = $this->db->get('customers');
        foreach ($customers as $customer) {
            if($customerName==$customer['name']){
                $customer_id = $customer['id'];
            }
        }
        $this->db->Where('customer_id', $customer_id);
        $this->db->delete('booking');
    }
    public function deleteBookingByTicket($ticket_id)
    {
        $this->db->Where('ticket_id', $ticket_id);
        $this->db->delete('booking');
    }
    public function deleteBookingByHotel($hotelName)
    {
        $hotels = $this->db->get('hotels');
        foreach ($hotels as $hotel) {
            if($hotelName==$hotel['name']){
                $hotel_id = $hotel['id'];
            }
        }
        $this->db->Where('hotel_id', $hotel_id);
        $this->db->delete('booking');
    }
}
