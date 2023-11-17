<?php

class BookingController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }
    public function index(){
        $bookings = $this->model->getAllBooking();
    }
    public function getBookingByID($id){
        $booking = $this->model->getBookingByID($id);
    }
    public function getBookingByHotel($hotelName){
        $booking = $this->model->getBookingByHotel($hotelName);
    }
    public function getBookingByCustomer($customerName){
        $booking = $this->model->getBookingByCustomer($customerName);
    }
    public function getBookingByDate($date){
        $booking = $this->model->getBookingByDate($date);
    }
    public function getBookingByTicket($ticket){
        $booking = $this->model->getBookingByTicket($ticket);
    }
    public function addBooking(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_id=$_POST['customer_id'];
            $hotel_id=$_POST['hotel_id'];
            $ticket_id = $_POST['ticket_id'];
            $date = $_POST['date'];
            $data = [
                'customer_id' =>$customer_id ,
                'hotel_id' => $hotel_id ,
                'ticket_id' => $ticket_id,
                'date' => $date
            ];
            
            if ($this->model->addBooking($data)) {
                echo "Booking added successfully!";
                // header("REFRESH:0 ; URL="");
            } else {
                echo "Failed to add user.";
            }
        }
    }
}