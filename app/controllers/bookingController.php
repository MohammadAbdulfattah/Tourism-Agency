<?php
class BookingController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }
    public function index()
    {
        $bookings = $this->model->getAllBooking();
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
    public function getBookingByID($id)
    {
        $booking = $this->model->getBookingByID($id);
    }
    public function getBookingByHotel($hotelName)
    {
        $booking = $this->model->getBookingByHotel($hotelName);
    }
    public function getBookingByCustomer($customerName)
    {
        $booking = $this->model->getBookingByCustomer($customerName);
    }
    public function getBookingByDate($date)
    {
        $booking = $this->model->getBookingByDate($date);
    }
    public function getBookingByTicket($ticket)
    {
        $booking = $this->model->getBookingByTicket($ticket);
    }
    public function addBooking()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_id = $_POST['customer_id'];
            $hotel_id = $_POST['hotel_id'];
            $ticket_id = $_POST['ticket_id'];
            $date = $_POST['date'];
            $data = [
                'customer_id' => $customer_id,
                'hotel_id' => $hotel_id,
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
    public function editBooking()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_id = $_POST['customer_id'];
            $hotel_id = $_POST['hotel_id'];
            $ticket_id = $_POST['ticket_id'];
            $date = $_POST['date'];
            $data = [
                'customer_id' => $customer_id,
                'hotel_id' => $hotel_id,
                'ticket_id' => $ticket_id,
                'date' => $date
            ];

            if ($this->model->editBooking($data, $_GET['id'])) {
                echo "Booking edited successfully!";
                // header("REFRESH:0 ; URL="");
            } else {
                echo "Failed to edit booking.";
            }
        }
    }
    public function editBookingByCustomer()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_id = $_POST['customer_id'];
            $hotel_id = $_POST['hotel_id'];
            $ticket_id = $_POST['ticket_id'];
            $date = $_POST['date'];
            $data = [
                'customer_id' => $customer_id,
                'hotel_id' => $hotel_id,
                'ticket_id' => $ticket_id,
                'date' => $date
            ];

            if ($this->model->editBookingByCustomer($data, $_GET['customerName'])) {
                echo "Booking edited successfully!";
                // header("REFRESH:0 ; URL="");
            } else {
                echo "Failed to edit booking.";
            }
        }
    }
    public function editBookingByTicket()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_id = $_POST['customer_id'];
            $hotel_id = $_POST['hotel_id'];
            $ticket_id = $_POST['ticket_id'];
            $date = $_POST['date'];
            $data = [
                'customer_id' => $customer_id,
                'hotel_id' => $hotel_id,
                'ticket_id' => $ticket_id,
                'date' => $date
            ];

            if ($this->model->editBookingByTicket($data, $_GET['ticket_id'])) {
                echo "Booking edited successfully!";
                // header("REFRESH:0 ; URL="");
            } else {
                echo "Failed to edit booking.";
            }
        }
    }
    public function editBookingByHotel()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_id = $_POST['customer_id'];
            $hotel_id = $_POST['hotel_id'];
            $ticket_id = $_POST['ticket_id'];
            $date = $_POST['date'];
            $data = [
                'customer_id' => $customer_id,
                'hotel_id' => $hotel_id,
                'ticket_id' => $ticket_id,
                'date' => $date
            ];

            if ($this->model->editBookingByHotel($data, $_GET['hotelName'])) {
                echo "Booking edited successfully!";
                // header("REFRESH:0 ; URL="");
            } else {
                echo "Failed to edit booking.";
            }
        }
    }
    public function editBookingByDate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_id = $_POST['customer_id'];
            $hotel_id = $_POST['hotel_id'];
            $ticket_id = $_POST['ticket_id'];
            $date = $_POST['date'];
            $data = [
                'customer_id' => $customer_id,
                'hotel_id' => $hotel_id,
                'ticket_id' => $ticket_id,
                'date' => $date
            ];

            if ($this->model->editBookingByDate($data, $_GET['date'])) {
                echo "Booking edited successfully!";
                // header("REFRESH:0 ; URL="");
            } else {
                echo "Failed to edit booking.";
            }
        }
    }
    public function deleteBooking()
    {
        $this->model->deleteBookingByID($_GET['id']);
    }
    public function deleteBookingDate()
    {
        $this->model->deleteBookingByDate($_GET['date']);
    }
    public function deleteBookingCustomer()
    {
        $this->model->deleteBookingByCustomer($_GET['customerName']);
    }
    public function deleteBookingHotel()
    {
        $this->model->deleteBookingByHotel($_GET['hotelName']);
    }
    public function deleteBookingTicket()
    {
        $this->model->deleteBookingByTicket($_GET['ticket_id']);
    }
}
