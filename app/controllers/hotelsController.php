9<?php
class HotelsController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }
    public function allHotels()
    {
        if ($hotels = $this->model->getAllHotels()) {
            echo json_encode(array('status' => 'true', 'data' => $hotels));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'there is some thing wrong'));
        }
        include "app/views/hotelsView.php";
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
                echo json_encode(array('status' => 'true', 'data' => $hotels));
            } else {
                echo json_encode(array('status' => 'false', 'message' => 'there is some thing wrong'));
            }
            include "app/views/hotelInfo.php";
        }
    }
    public function getHotelByID($id)
    {
        if ($hotels = $this->model->getHotelsByID($id)) {
            echo json_encode(array('status' => 'true', 'data' => $hotels));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'there is some thing wrong'));
        }
        include "app/views/hotelInfo.php";
    }
    public function getHotelsByPhone($phone)
    {
        if ($hotels = $this->model->getHotelByPhone($phone)) {
            echo json_encode(array('status' => 'true', 'data' => $hotels));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'there is some thing wrong'));
        }
        include "app/views/hotelsView.php";
    }
    public function getHotelsByCity($cityName)
    {
        if ($hotels = $this->model->getHotelsByCity($cityName)) {
            echo json_encode(array('status' => 'true', 'data' => $hotels));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'there is some thing wrong'));
        }
        include "app/views/hotelsView.php";
    }
    public function getHotelByName($name)
    {
        if ($hotels = $this->model->getHotelByName($name)) {
            echo json_encode(array('status' => 'true', 'data' => $hotels));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'there is some thing wrong'));
        }
        include "app/views/hotelsView.php";
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
                header("REFRESH:0 ; URL=" . BASE_PATH);
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
            if (isset($_GET['id'])) {
                if ($this->model->editHotelByID($data, $_GET['id'])) {
                    echo "Hotel info edited successfully!";
                    header("REFRESH:0 ; URL=" . BASE_PATH . 'edit');
                } else {
                    echo "Failed to edit hotel.";
                }
            } else {
?>
                <script>
                    alert("no ID provided to edit hotel !!")
                </script>
            <?php
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
            if (isset($_GET['name'])) {
                if ($this->model->editHotelByName($data, $_GET['name'])) {
                    echo "Hotel info edited successfully!";
                    header("REFRESH:0 ; URL=" . BASE_PATH);
                } else {
                    echo "Failed to edit hotel.";
                }
            } else {
            ?>
                <script>
                    alert("no hotel name provided to edit hotel !!")
                </script>
            <?php
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
            if (isset($_GET['phone'])) {
                if ($this->model->editHotelByPhone($data, $_GET['phone'])) {
                    echo "Hotel info edited successfully!";
                    header("REFRESH:0 ; URL=" . BASE_PATH);
                } else {
                    echo "Failed to edit hotel.";
                }
            } else {
            ?>
                <script>
                    alert("no phone number provided to edit hotel !!")
                </script>
            <?php
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
            if (isset($_GET['cityName'])) {
                if ($this->model->editHotelByCity($data, $_GET['cityName'])) {
                    echo "Hotel info edited successfully!";
                    header("REFRESH:0 ; URL=" . BASE_PATH);
                } else {
                    echo "Failed to edit hotel.";
                }
            } else {
            ?>
                <script>
                    alert("no City name provided to edit hotel !!")
                </script>
            <?php
            }
        }
    }
    public function deleteHotel()
    {
        if (isset($_GET['id'])) {
            $this->model->deleteHotel($_GET['id'])

            ?>
            <script>
                alert("Hotel data has been deleted successfully");
            </script>
        <?php
            header("REFRESH:0 ; URL=" . BASE_PATH);
        } else {
        ?>
            <script>
                alert("no ID provided to delete hotel !!")
            </script>
            <?php
        }
    }
    public function deleteHotelByCity()
    {
        if (isset($_GET['cityName'])) {
            if ($this->model->deleteHotelByItsCity($_GET['cityName'])) {
            ?>
                <script>
                    alert("Hotel data has been deleted successfully");
                </script>
            <?php
                header("REFRESH:0 ; URL=" . BASE_PATH);
            } else {
            ?>
                <script>
                    alert("there is something wrong please try again!!")
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                alert("no ID provided to delete hotel !!")
            </script>
<?php
        }
    }
}
