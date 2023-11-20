<?php
class CompaniesController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }
    public function allCompanies()
    {
        if ($companies = $this->model->getAllCompanies()) {
            echo json_encode(array('status' => 'true', 'data' => $companies));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'there is some thing wrong'));
        }
        include "app/views/hotelsView.php";
    }
    public function addCompany()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $data = [
                'name' => $name,
                'phone' => $phone
            ];
            if ($this->model->addCompany($data)) {
                echo "Company added successfully!";
                header("REFRESH:0 ; URL=" . BASE_PATH);
            } else {
                echo "Failed to add company.";
            }
        } else {
            echo "Invalid request method";
        }
    }
    public function editCompany()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $data = [
                'name' => $name,
                'phone' => $phone
            ];
            if (isset($_GET['id'])) {
                if ($this->model->editCompany($data, $_GET['id'])) {
                    echo "company info edited successfully!";
                    header("REFRESH:0 ; URL=" . BASE_PATH . 'edit');
                } else {
                    echo "Failed to edit company.";
                }
            } else {
?>
                <script>
                    alert("no ID provided to edit company !!")
                </script>
            <?php
            }
        } else {
            echo "Invalid request method";
        }
    }
    public function deleteCompany()
    {
        if (isset($_GET['id'])) {
            $this->model->deleteCompany($_GET['id'])
            ?>
            <script>
                alert("Company data has been deleted successfully");
            </script>
        <?php
            header("REFRESH:0 ; URL=" . BASE_PATH);
        } else {
        ?>
            <script>
                alert("no ID provided to delete Company !!")
            </script>
<?php
        }
    }
}
