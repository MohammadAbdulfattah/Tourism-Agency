<?php
class BookingModel
{
    public $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getAllCustomers(){
        $customers = $this->db->get('customers');
        return $customers;
    }
    public function getAllHotels(){
        $hotels = $this->db->get('hotels');
        return $hotels;
    }
    public function getBookingCustomer($customer_id)
    {
        $this->db->Where('id', $customer_id);
        $customers = $this->db->get('customers');
        foreach ($customers as $customer) {
            $customerName = $customer['name'];
            return $customerName;
        }
    }
    public function getBookingHotel($hotel_id)
    {
        $this->db->Where('id', $hotel_id);
        $hotels = $this->db->get('hotels');
        foreach ($hotels as $hotel) {
            $hotelName = $hotel['name'];
            return $hotelName;
        }
    }
    public function getBookingTicket($ticket_id)
    {
        $this->db->Where('id', $ticket_id);
        $tickets = $this->db->get('tickets');
        foreach ($tickets as $ticket) {
            $ticketDate = $ticket['date_e'];
            return $ticketDate;
        }
    }
    public function getAllBooking()
    {
        return $this->db->get('booking');
    }
    public function getBookingBySpcInfo($conditions)
    {
        //condition : column = condition;
        // if the value is string do not forget to put ''
        $sql = '';
        if (!empty($conditions)) {
            for ($i = 0; $i < count($conditions); $i++) {
                $sql .= $conditions[$i];
                for ($j = 0; $j < 1; $j++) {
                    $sql .= ' AND ';
                }
            }
            $sql = rtrim($sql, 'AND ');
            $query = "SELECT * FROM booking WHERE " .$sql;
            return $this->db->rawQuery($query);
        }
    }
    public function getBookingByID($id)
    {
        $this->db->Where('id', $id);
        return $this->db->get('booking');
    }
    public function getBookingByHotel($hotelName)
    {
        $hotels = $this->db->get('hotels');
        foreach ($hotels as $hotel) {
            if ($hotelName == $hotel['name']) {
                $hotel_id = $hotel['id'];
            }
        }
        $this->db->where("hotel_id", $hotel_id);
        return $this->db->get('booking');
    }
    public function getBookingByCustomer($customerName)
    {
        $customers = $this->db->get('customers');
        foreach ($customers as $customer) {
            if ($customerName == $customer['name']) {
                $customer_id = $customer['id'];
            } else {
                echo json_encode(array('status' => 'false','message' => 'there is no customer in this name'));
            }
        }
        $this->db->where("customer_id", $customer_id);
        return $this->db->get('booking');
    }
    public function getBookingByDate($date)
    {
        $this->db->where("date", $date);
        return $this->db->get('booking');
    }
    public function getBookingByTicket($ticket_id)
    {
        $this->db->where("ticket_id", $ticket_id);
        return $this->db->get('booking');
    }
    public function addBooking($data)
    {
        return $this->db->insert('booking', $data);
    }
    public function editBooking($data, $id)
    {
        $this->db->Where('id', $id);
        return $this->db->update('booking', $data);
    }
    public function editBookingByCustomer($data, $customerName)
    {
        $customers = $this->db->get('customers');
        foreach ($customers as $customer) {
            if ($customerName == $customer['name']) {
                $customer_id = $customer['id'];
            } else {
                echo json_encode(array('status' => 'false','message' => 'there is no customer in this name'));
            }
        }
        $this->db->Where('customer_id', $customer_id);
        return $this->db->update('booking', $data);
    }
    public function editBookingByTicket($data, $ticket_id)
    {
        $this->db->Where('ticket_id', $ticket_id);
        return $this->db->update('booking', $data);
    }
    public function editBookingByDate($data, $date)
    {
        $this->db->Where('date', $date);
        return $this->db->update('booking', $data);
    }
    public function editBookingByHotel($data, $hotelName)
    {
        $hotels = $this->db->get('hotels');
        foreach ($hotels as $hotel) {
            if ($hotelName == $hotel['name']) {
                $hotel_id = $hotel['id'];
            } else {
                echo json_encode(array('status' => 'false','message' => 'there is no hotel in this name'));
            }
        }
        $this->db->Where('hotel_id', $hotel_id);
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
            if ($customerName == $customer['name']) {
                $customer_id = $customer['id'];
            } else {
                echo json_encode(array('status' => 'false','message' => 'there is no customer in this name'));
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
            if ($hotelName == $hotel['name']) {
                $hotel_id = $hotel['id'];
            } else {
                echo json_encode(array('status' => 'false','message' => 'there is no hotel in this name'));
            }
        }
        $this->db->Where('hotel_id', $hotel_id);
        $this->db->delete('booking');
    }
    
}
