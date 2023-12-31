<?php

class AdminsController
{

    private $model;

    public function __construct($db)
    {
        $this->model = new AdminsModel($db);
    }

    public function deleteAdmins($id)
    {
        $result = $this->model->deleteAdmins($id);
        if ($result) {
            echo json_encode(array('status' => 'true', 'messege' => 'Admin deleted successfully!'));
        } else {
            echo json_encode(array('status' => 'false', 'messege' => 'Failed to delete Admin.'));
        }
    }

    public function updateAdmins($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['name']) && isset($_POST['password'])) {
                $name = $_POST['name'];
                $password = $_POST['password'];
                if (strlen($password) >= 8) {
                    $data = [
                        'password' => $password
                    ];
                } else {
                    echo json_encode(array('status' => 'false', 'messege' => 'The Password is Less Than 8 Character'));
                    return;
                }
                $data = [
                    'name' => $name,
                    'password' => $password
                ];
            } else if (isset($_POST['name'])) {
                $name = $_POST['name'];
                $data = [
                    'name' => $name
                ];
            } else if (isset($_POST['password'])) {
                $password = $_POST['password'];
                if (strlen($password) >= 8) {
                    $data = [
                        'password' => $password
                    ];
                } else {
                    echo json_encode(array('status' => 'false', 'messege' => 'The Password is Less Than 8 Character'));
                }
            }

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

    public function generateRandomString($length = 25) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
            $token = $this->generateRandomString();
            if ($this->model->searchEmailAdmins($email)) {
                if ($this->model->searchPassAdmins($password)) {
                    $id = $this->model->getIdByEmail($email);
                    $data = ['token' => $token];
                    $this->model->updateAdmins($id,$data);
                    $token = $this->model->getTokenById($id);
                    echo json_encode(array('status' => 'true', 'data' => ['token' => $token,'messege' => 'You Can Access']));
                } else {
                    echo json_encode(array('status' => 'false', 'messege' => 'Incroect Password'));
                }
            } else {
                echo json_encode(array('status' => 'false', 'messege' => 'The email you entered is not connected to an account'));
            }
        }
    }
    public function logout(){
        foreach (getallheaders() as $key => $value) {
            if($key == 'token') {
                $id = $this->model->getIdByToken($value);
                $data = ['token' => NULL];
                if ($this->model->updateAdmins($id, $data)) {
                    echo json_encode(array('status' => 'true', 'messege' => 'Admin Logout successfully!'));
                } else {
                    echo json_encode(array('status' => 'false', 'messege' => 'Failed to logout'));
                }
            }
        }
    }

    public function check(){
        foreach (getallheaders() as $key => $value) {
            if($key == 'token') {
                if($this->model->getToken($value)){
                    return true;
                }
            }
        }
        echo json_encode(array('status' => 'false', 'messege' => 'please login first'));
        return false;
    }
}
