<?php
class CustomerModel{
    public $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function getCustomerByid($id){
        $this->db->Where('id', $id);
        return $this->db->get('customers');
    }
}