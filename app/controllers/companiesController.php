<?php
class CompaniesController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new CompaniesModel($db);
    }
    public function allCompanies()
    {
        if ($companies = $this->model->getAllCompanies()) {
            $data = array();
            foreach ($companies as $company) {
                $companyName = $company['name'];
                $companyPhone = $company['phone'];
                array_push($data, $companyName, $companyPhone);
            }
            echo json_encode(array('status' => 'true', 'data' => $data));
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'there is some thing wrong'));
        }
    }
    public function addCompany()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = @$_POST['name'];
            $phone = @$_POST['phone'];
            if (!empty($name) && !empty($phone)) {

                $data = [
                    'name' => $name,
                    'phone' => $phone
                ];
                if ($this->model->addCompany($data)) {
                    echo json_encode(array('status' => 'true', 'message' => 'Company added successfully!'));
                } else {
                    echo json_encode(array('status' => 'false', 'message' => 'Failed to add company'));
                }
            } else {
                echo json_encode(array('status' => 'false', 'message' => 'please enter all data'));
            }
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'Invalid request method'));
        }
    }
    public function editCompany()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $IDs = array();
            $companies = $this->model->getAllCompanies();
            foreach ($companies as $company) {
                $id = $company['id'];
                array_push($IDs, $id);
            }
            $name = @@$_POST['name'];
            $phone = @@$_POST['phone'];
            if (!empty($name) && !empty($phone)) {

                $data = [
                    'name' => $name,
                    'phone' => $phone
                ];
                if (isset($_GET['id'])) {
                    if (in_array($_GET['id'], $IDs)) {

                        if ($this->model->editCompanyByID($data, @$_GET['id'])) {
                            echo json_encode(array('status' => 'true', 'message' => 'company info edited successfully!'));
                        } else {
                            echo json_encode(array('status' => 'false', 'message' => 'Failed to edit company'));
                        }
                    } else {
                        echo json_encode(array('status' => 'false', 'message' => 'wrong id'));
                    }
                } else {
                    echo json_encode(array('status' => 'false', 'message' => 'no ID provided to edit company !!'));
                }
            } else {
                echo json_encode(array('status' => 'false', 'message' => 'please enter all data'));
            }
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'Invalid request method'));
        }
    }
    public function deleteCompany()
    {
        $IDs = array();
        $companies = $this->model->getAllCompanies();
        foreach ($companies as $company) {
            $id = $company['id'];
            array_push($IDs, $id);
        }
        if (isset($_GET['id'])) {
            if (in_array($_GET['id'], $IDs)) {
                $this->model->deleteCompany($_GET['id']);
                echo json_encode(array('status' => 'true', 'message' => 'Company data has been deleted successfully'));
            } else {
                echo json_encode(array('status' => 'false', 'message' => 'wrong id'));
            }
        } else {
            echo json_encode(array('status' => 'false', 'message' => 'no ID provided to delete Company !!'));
        }
    }
}
