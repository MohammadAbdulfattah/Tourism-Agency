<?php
Class customersModel{
    private $db;
    public function __construct($db)
    {
        $this->db=$db;
    }
    public function addCustomer($data){
        return $this->db->insert('customers',$data);
    }
    public function getCustomer()
    {
        return $this->db->get('customers');
    }
    public function getCustomerByid($id)
    {
        return $this->db->where('id',$id)->getOne('customers');
    }
    public function getCustomerByname($condition){
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