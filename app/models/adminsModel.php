<?php 
    class AdminsModel{
        public $db;
        public function __construct($db){
            $this->db = $db;
        }
        public function getAdmins() {
            return $this->db->get('admins');
        }
        public function addAdmins($data) {
            return $this->db->insert('admins', $data);
        }
        public function getAdminsById($id) {
            return $this->db->where('id', $id)->getOne('admins');
        }
        public function getIdByToken($token) {
            $result = $this->db->where('token', $token)->getOne('admins');
            foreach ($result as $key => $value) {
                if($key == 'id'){
                    return $value;
                }
            }
        }
        public function getTokenById($id) {
            $result = $this->db->where('id', $id)->getOne('admins');
            foreach ($result as $key => $value) {
                if($key == 'token'){
                    return $value;
                }
            }
        }
        public function getIdByEmail($email) {
            $result = $this->db->where('email', $email)->getOne('admins');
            foreach ($result as $key => $value) {
                if($key == 'id'){
                    return $value;
                }
            }
        }
        public function getToken($token) {
            $result = $this->db->where('token', $token)->getOne('admins');
            if(!empty($result)){
                foreach ($result as $key => $value) {
                    if($key == 'token'){
                        return true;
                    }
                }
            }
            return false;
        }
        public function updateAdmins($id, $data) {
            $this->db->where('id', $id);
            return $this->db->update('admins', $data);
        }
    
        public function deleteAdmins($id) {
            $this->db->where('id', $id);
            $resutlt = $this->db->get('admins');
            if($resutlt){
                $this->db->where('id', $id);
                return $this->db->delete('admins');
            }
            return false;
        }
        //check for email and password
        public function searchEmailAdmins($email) {
            $this->db->where ('email', $email);
            $results = $this->db->get ('admins');
            return $results;
        }
        public function searchPassAdmins($password) {
            $this->db->where ('password', $password);
            $results = $this->db->get ('admins');
            return $results;
        }
    }
?>
