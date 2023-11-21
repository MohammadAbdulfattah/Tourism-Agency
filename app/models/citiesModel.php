<?php

Class citiesModel{
    private $db;
    public function __construct($db){
        $this->db=$db;
    }
    public function addCity($data){
        return $this->db->insert('cities',$data);
    }
    public function getCity(){
        return $this->db->get('cities');
    }
    public function getCityByid($id){
        return $this->db->where('id',$id)->getOne('cities');
    }
    public function updateCity($id,$update){
        $this->db->where('id',$id);
        return $this->db->update('cities',$update);
    }
    public function deleteCity($id){
        $this->db->where('id',$id); 
        return $this->db->delete('cities');
    }
    public function getCityByname($condition){
        $this->db->where('name',$condition,'LIKE');
        return $this->db->get('cities');

    }
}