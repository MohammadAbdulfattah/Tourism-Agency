<?php
require __DIR__ . '/../models/adminsModel.php';

class AdminsControllers{

    private $model;

    public function __construct($db){
        $this->model = new AdminsModel($db);
    }

    public function index(){
        $users = $this->model->getAdmins();
        //include __DIR__ . '/../views/Admins_list.php';
    }

    public function showAdmins(){
        $users = $this->model->getAdmins();
        //include '../views/admin_list.php';
    }

    public function deleteAdmins($id){
        if ($this->model->deleteAdmins($id)) {
            echo "User deleted successfully!";
            //header('Location:' . BASE_PATH);
        } else {
            echo "Failed to delete user.";
        }
    }

    public function updateAdmins($id){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $password = $_POST['password'];
            $data = [
                'name'=> $name,
                'password' => $password,
            ];

            if ($this->model->updateAdmins($id, $data)) {
                echo "User updated successfully!";
                //header('Location:' . BASE_PATH);
            } else {
                echo "Failed to update user.";
            }
        } else {
            $user = $this->model->getAdminsById($id);
            //include __DIR__ . '/../views/edit_user.php';
        }
    }

    public function checkForValidEmail($email){
        $result = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    public function checkPasswordLength($password){
        $passwordCount = strlen($password);
        if ($passwordCount < 8) {
        return false;
        } else {
        return true;
        }
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ];}
        // validation check
        if($this->checkForValidEmail($email)){
            if($this->checkPasswordLength($password)){
                $this->model->addAdmins($data);
                //header('Location:' . BASE_PATH);
                echo 'done';
            } else {
                    echo "incorect password";
            }
        } else {
            echo "incorect email";
        }
        
    }

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if($this->model->searchAdmins($email, $password)){
                echo "access";
            } else {
                echo "do not found";
            }
        }
    }
}

?>