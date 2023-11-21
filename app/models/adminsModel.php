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

        public function updateAdmins($id, $data) {
            $this->db->where('id', $id);
            return $this->db->update('admins', $data);
        }
    
        public function deleteAdmins($id) {
            $this->db->where('id', $id);
            return $this->db->delete('admins');
        }
        //check for email and password
        public function searchAdmins($email,$password) {
            $this->db->where ('email', $email);
            $this->db->where ('password', $password);
            $results = $this->db->get ('admins');
            return $results;
        }
    }
?>
