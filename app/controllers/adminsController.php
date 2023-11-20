<?php
require __DIR__ . '/../models/adminsModel.php';

class AdminsController
{

    private $model;

    public function __construct($db)
    {
        $this->model = new AdminsModel($db);
    }
  
    public function index(){
        //$users = $this->model->getAdmins();
        //include __DIR__ . '/../views/Admins_list.php';
    }

    public function showAdmins(){
        $users = $this->model->getAdmins();
        //include '../views/admin_list.php';
    }

    public function deleteAdmins($id){
        if ($this->model->deleteAdmins($id)) {
            echo json_encode(array('status' => 'true', 'messege' => 'Admin deleted successfully!'));
        } else {
            echo json_encode(array('status' => 'false', 'messege' => 'Failed to delete Admin.'));
        }
    }
  
    public function updateAdmins($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $password = $_POST['password'];
            $data = [
                'name' => $name,
                'password' => $password,
            ];

            if ($this->model->updateAdmins($id, $data)) {
                echo json_encode(array('status' => 'true', 'messege' => 'Admin updated successfully!'));
            } else {
                echo json_encode(array('status' => 'false', 'messege' => 'Failed to edit Admin.'));
            }
        }
    }

    public function checkForValidEmail($email)
    {
        $result = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    public function checkPasswordLength($password)
    {
        $passwordCount = strlen($password);
        if ($passwordCount < 8) {
            return false;
        } else {
            return true;
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ];
        }
        // validation check
        $result = $this->model->getAdmins();
        foreach ($result as $res) {
            foreach ($res as $key => $value) {
                if ($key == 'email' && $value == $email) {
                    echo json_encode(array('status' => 'false', 'messege' => 'The Email Is Already Exist'));
                    return;
                }
            }
        }
        if ($this->checkForValidEmail($email)) {
            if ($this->checkPasswordLength($password)) {
                $this->model->addAdmins($data);
                //header('Location:' . BASE_PATH);
                echo json_encode(array('status' => 'true', 'messege' => 'Admin Add Successfuly!'));
            } else {
                echo json_encode(array('status' => 'false', 'messege' => 'Incorect Password'));
            }
        } else {
            echo json_encode(array('status' => 'false', 'messege' => 'Incorect Email'));
        }
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if ($this->model->searchAdmins($email, $password)) {
                echo json_encode(array('status' => 'true', 'messege' => 'You Can Access'));
            } else {
                echo json_encode(array('status' => 'false', 'messege' => 'The email you entered isn’t connected to an account'));
            }
        }
    }
}
