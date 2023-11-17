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

    public function addAdmins(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ];

            if ($this->model->addAdmins($data)) {
                //header('Location:' . BASE_PATH);
                echo 'done';
            } else {
                echo "Failed to add new Admin.";
            }
        }
    }

    public function showAdmins()
    {
        $users = $this->model->getAdmins();
        //include '../views/admin_list.php';
    }

    public function deleteAdmins($id)
    {
        if ($this->model->deleteAdmins($id)) {
            echo "User deleted successfully!";
            //header('Location:' . BASE_PATH);
        } else {
            echo "Failed to delete user.";
        }
    }

    public function updateAdmins($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $data = [
                'name'=> $name,
                'email' => $email,
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
}

?>