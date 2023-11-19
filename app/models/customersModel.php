<?php
namespace app\models;
 
Class customersModel{
    private $db;
    public function __construct($db)
    {
        $this->db=$db;
    }
    public function addCustomer($data)
    {
        return $this->db->insert('customers',$data);
    }
    public function getCustomer()
    {
        return $this->db->get('custoners');
    }
    public function getCustomerByid($id)
    {
        return $this->db->where('id',$id)->getOne('customers');
    }
    // public function getCustomerByname($name)
    // {
    //     return $this->db->where('name',$name)->getOne('customers');
    // }
    public function searchCustomer($condition){
        $this->db->where('name',$condition,'LIKE');
        return $this->db->get('customers');
    }
    public function updateCustomer($id,$update)
    {
        $this->db->where('id',$id);
        return $this->db->update('customers',$update);
    }
    public function deleteCustomer($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete('customers');
    }
}
?>