<?php
class BookingController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }
    public function getBookingCustomer($customer_id){
        $customerName = $this->model->getBookingCustomer($customer_id);
        return $customerName;
    }
    public function getBookingHotel($hotel_id){
        $hotelName = $this->model->getBookingHotel($hotel_id);
        return $hotelName;
    }
    public function getBookingTicket($ticket_id){
        $ticketDate = $this->model->getBookingTicket($ticket_id);
        return $ticketDate;
    }
    public function allBookings()
    {
        if ($bookings = $this->model->getAllBooking()) {
            $data = array();
            foreach ($bookings as $booking) {
                $hotelName = $this->getBookingHotel($booking['hotel_id']);
                $ticketDate = $this->getBookingTicket($booking['ticket_id']);
                $customerName = $this->getBookingCustomer($booking['customer_id']);
                $date = $booking['date'];
                array_push($data, $customerName, $ticketDate, $hotelName,$date);
            }
            echo json_encode(array('status' => 'true', 'data' => $data));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'there is some thing wrong'));
        }
    }
    public function getBookingBySpcInfo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conditions = array();
            foreach ($_POST as $key => $value) {
                $condition = "$key = '$value'";
                array_push($conditions, $condition);
            }
            if ($bookings = $this->model->getBookingBySpcInfo($conditions)) {
                $data = array();
                foreach ($bookings as $booking) {
                    $hotelName = $this->getBookingHotel($booking['hotel_id']);
                    $ticketDate = $this->getBookingTicket($booking['ticket_id']);
                    $customerName = $this->getBookingCustomer($booking['customer_id']);
                    $date = $booking['date'];
                    array_push($data, $customerName, $ticketDate, $hotelName, $date);
                }
                echo json_encode(array('status' => 'true', 'data' => $data));
            } else {
                echo json_encode(array('status' => 'false', 'message' => 'there is some thing wrong'));
            }
            include "app/views/bookingsInfo.php";
        }
    }
    public function getBookingByID($id)
    {
        if ($bookings = $this->model->getBookingByID($id)) {
            $data = array();
                foreach ($bookings as $booking) {
                    $hotelName = $this->getBookingHotel($booking['hotel_id']);
                    $ticketDate = $this->getBookingTicket($booking['ticket_id']);
                    $customerName = $this->getBookingCustomer($booking['customer_id']);
                    $date = $booking['date'];
                    array_push($data, $customerName, $ticketDate, $hotelName, $date);
                }
            echo json_encode(array('status' => 'true', 'data' => $data));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'there is some thing wrong'));
        }
        include "app/views/bookingsInfo.php";
    }
    public function getBookingByHotel($hotelName)
    {
        if ($bookings = $this->model->getBookingByHotel($hotelName)) {
            $data = array();
                foreach ($bookings as $booking) {
                    $hotelName = $this->getBookingHotel($booking['hotel_id']);
                    $ticketDate = $this->getBookingTicket($booking['ticket_id']);
                    $customerName = $this->getBookingCustomer($booking['customer_id']);
                    $date = $booking['date'];
                    array_push($data, $customerName, $ticketDate, $hotelName, $date);
                }
            echo json_encode(array('status' => 'true', 'data' => $data));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'there is some thing wrong'));
        }
        include "app/views/bookingsInfo.php";
    }
    public function getBookingByCustomer($customerName)
    {
        if ($bookings = $this->model->getBookingByCustomer($customerName)) {
            $data = array();
                foreach ($bookings as $booking) {
                    $hotelName = $this->getBookingHotel($booking['hotel_id']);
                    $ticketDate = $this->getBookingTicket($booking['ticket_id']);
                    $customerName = $this->getBookingCustomer($booking['customer_id']);
                    $date = $booking['date'];
                    array_push($data, $customerName, $ticketDate, $hotelName, $date);
                }
            echo json_encode(array('status' => 'true', 'data' => $data));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'there is some thing wrong'));
        }
        include "app/views/bookingsInfo.php";
    }
    public function getBookingByDate($date)
    {
        if ($bookings = $this->model->getBookingByDate($date)) {
            $data = array();
                foreach ($bookings as $booking) {
                    $hotelName = $this->getBookingHotel($booking['hotel_id']);
                    $ticketDate = $this->getBookingTicket($booking['ticket_id']);
                    $customerName = $this->getBookingCustomer($booking['customer_id']);
                    $date = $booking['date'];
                    array_push($data, $customerName, $ticketDate, $hotelName, $date);
                }
            echo json_encode(array('status' => 'true', 'data' => $data));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'there is some thing wrong'));
        }
        include "app/views/bookingsInfo.php";
    }
    public function getBookingByTicket($ticket)
    {
        if ($bookings = $this->model->getBookingByTicket($ticket)) {
            $data = array();
                foreach ($bookings as $booking) {
                    $hotelName = $this->getBookingHotel($booking['hotel_id']);
                    $ticketDate = $this->getBookingTicket($booking['ticket_id']);
                    $customerName = $this->getBookingCustomer($booking['customer_id']);
                    $date = $booking['date'];
                    array_push($data, $customerName, $ticketDate, $hotelName, $date);
                }
            echo json_encode(array('status' => 'true', 'data' => $data));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'there is some thing wrong'));
        }
        include "app/views/bookingsInfo.php";
    }
    public function addBooking()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customersID = array();
            $hotelsID = array();
            $customers = $this->model->getAllCustomers();
            $hotels = $this->model->getAllHotels();
            foreach ($customers as $customer) {
                array_push($customersID, $customer['id']);
            }
            foreach ($hotels as $hotel) {
                array_push($hotelsID, $hotel['id']);
            }
            if(in_array($_POST['customer_id'],$customersID)){
                if(in_array($_POST['hotel_id'],$hotelsID)){

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
                        header("REFRESH:0 ; URL=" . BASE_PATH);
                    } else {
                        echo "Failed to add user.";
                    }
                }else{
                    echo "Please select a valid hotel";
                }
            }else{
                echo "Please select a valid customer";
            }
        }else{
            echo "Invalid request method";
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
            if (isset($_GET['id'])) {
                if ($this->model->editBooking($data, $_GET['id'])) {
                    echo "Booking edited successfully!";
                    header("REFRESH:0 ; URL=" . BASE_PATH);
                } else {
                    echo "Failed to edit booking.";
                }
            } else {
?>
                <script>
                    alert("No ID provided for editing the booking.");
                </script>
            <?php
            }
        }else{
            echo "Invalid request method";
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
            if (isset($_GET['customerName'])) {
                if ($this->model->editBookingByCustomer($data, $_GET['customerName'])) {
                    echo "Booking edited successfully!";
                    header("REFRESH:0 ; URL=" . BASE_PATH);
                } else {
                    echo "Failed to edit booking.";
                }
            } else {
            ?>
                <script>
                    alert("No customer name provided for editing the booking.");
                </script>
            <?php
            }
        }else{
            echo "Invalid request method";
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
            if (isset($_GET['ticket_id'])) {
                if ($this->model->editBookingByTicket($data, $_GET['ticket_id'])) {
                    echo "Booking edited successfully!";
                    header("REFRESH:0 ; URL=" . BASE_PATH);
                } else {
                    echo "Failed to edit booking.";
                }
            } else {
            ?>
                <script>
                    alert("No ticket ID provided for editing the booking.");
                </script>
            <?php
            }
        }else{
            echo "Invalid request method";
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
            if (isset($_GET['hotelName'])) {
                if ($this->model->editBookingByHotel($data, $_GET['hotelName'])) {
                    echo "Booking edited successfully!";
                    header("REFRESH:0 ; URL=" . BASE_PATH);
                } else {
                    echo "Failed to edit booking.";
                }
            } else {
            ?>
                <script>
                    alert("No hotel name provided for editing the booking.");
                </script>
            <?php
            }
        }else{
            echo "Invalid request method";
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
            if (isset($_GET['date'])) {
                if ($this->model->editBookingByDate($data, $_GET['date'])) {
                    echo "Booking edited successfully!";
                    header("REFRESH:0 ; URL=" . BASE_PATH);
                } else {
                    echo "Failed to edit booking.";
                }
            } else {
            ?>
                <script>
                    alert("No date provided for editing the booking.");
                </script>
            <?php
            }
        }else{
            echo "Invalid request method";
        }
    }
    public function deleteBooking()
    {
        if ($this->model->deleteBookingByID($_GET['id'])) {
            ?>
            <script>
                alert("The booking has been deleted successfully");
            </script>
        <?php
            header("REFRESH:0 ; URL=" . BASE_PATH);
        } else {
        ?>
            <script>
                alert("Their is something wrong please try again!!");
            </script>
        <?php
        }
    }
    public function deleteBookingDate()
    {
        if ($this->model->deleteBookingByDate($_GET['date'])) {
        ?>
            <script>
                alert("The booking has been deleted successfully");
            </script>
        <?php
            header("REFRESH:0 ; URL=" . BASE_PATH);
        } else {
        ?>
            <script>
                alert("Their is something wrong please try again!!");
            </script>
        <?php
        }
    }
    public function deleteBookingCustomer()
    {
        if ($this->model->deleteBookingByCustomer($_GET['customerName'])) {
        ?>
            <script>
                alert("The booking has been deleted successfully");
            </script>
        <?php
            header("REFRESH:0 ; URL=" . BASE_PATH);
        } else {
        ?>
            <script>
                alert("Their is something wrong please try again!!");
            </script>
        <?php
        }
    }
    public function deleteBookingHotel()
    {
        if ($this->model->deleteBookingByHotel($_GET['hotelName'])) {
        ?>
            <script>
                alert("The booking has been deleted successfully");
            </script>
        <?php
            header("REFRESH:0 ; URL=" . BASE_PATH);
        } else {
        ?>
            <script>
                alert("Their is something wrong please try again!!");
            </script>
        <?php
        }
    }
    public function deleteBookingTicket()
    {
        if ($this->model->deleteBookingByTicket($_GET['ticket_id'])) {
        ?>
            <script>
                alert("The booking has been deleted successfully");
            </script>
        <?php
            header("REFRESH:0 ; URL=" . BASE_PATH);
        } else {
        ?>
            <script>
                alert("Their is something wrong please try again!!");
            </script>
<?php
        }
    }
}
