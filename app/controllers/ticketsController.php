<?php

class TicketsController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new TicketsModel($db);
    }
    public function getTicketCity($city_id){
        $cityname = $this->model->getCityName($city_id);
        return $cityname;
    }
    public function getTicketCompany($company_id){
        $companyname = $this->model->getCompanyName($company_id);
        return $companyname;
    }
    public function getAllTicket()
    {
        $tickets = $this->model->getAllTickets();
        if($tickets){
            $data = array();
            foreach ($tickets as $ticket){
                $companyName = $this->getTicketCompany($ticket['company_id']);
                $cityName = $this->getTicketCity($ticket['city_id']);
                $date_e = $ticket['date_e'];
                $date_s = $ticket['date_s'];
                array_push($data,$companyName,$cityName,$date_e,$date_s);
            }
            echo json_encode(array('status'=> 'true','data'=>$data));
        } else {
            echo json_encode(array('status'=> 'false', 'messege'=>'dont Found'));
        }
    }
    public function getTicketsByCompanyId($company_id)
    {
        $tickets = $this->model->getTicketByCompany($company_id);
        $data = array();
        if($tickets){
            foreach ($tickets as $ticket){
                $cityname = $this->getTicketCity($ticket['city_id']);
                $companyname = $this->getTicketCompany($ticket['company_id']);
                $date_e = $ticket['date_e'];
                $date_s = $ticket['date_s'];
                array_push($data,$companyname,$cityname,$date_e,$date_s);
            }
            echo json_encode(array('status'=> 'true','data'=>$data));
        }else {
            echo json_encode(array('status'=> 'false', 'messege'=>'dont Found'));
        }
        
    }
    public function getTicketsByCityId($city_id)
    {
        $tickets = $this->model->getTicketByCity($city_id);
        $data = array();
        if($tickets){
            foreach ($tickets as $ticket){
                $cityname = $this->getTicketCity($ticket['city_id']);
                $companyname = $this->getTicketCompany($ticket['company_id']);
                $date_e = $ticket['date_e'];
                $date_s = $ticket['date_s'];
                array_push($data,$companyname,$cityname,$date_e,$date_s);
            }
            echo json_encode(array('status'=> 'true','data'=>$data));
        }else {
            echo json_encode(array('status'=> 'false', 'messege'=>'dont Found'));
        }
        
    }

    public function addTickets()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $company_id = $_POST['company_id'];
            $city_id = $_POST['city_id'];
            $date_e = $_POST['date_e'];
            $date_s = $_POST['date_s'];
            $data = [
                'company_id' => $company_id,
                'city_id' => $city_id,
                'date_e' => $date_e,
                'date_s' => $date_s
            ];
            if ($this->model->addTicket($data)) {
                echo json_encode(array('status' => 'true', 'messege' => 'Rate added successfully!'));
            } else {
                echo json_encode(array('status' => 'false', 'messege' => 'Failed to add Rate.'));
            }
        }
    }

    public function editTickets()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date_e = $_POST['date_e'];
            $date_s = $_POST['date_s'];
            $data = [
                'date_e' => $date_e,
                'date_s' => $date_s
            ];
            if ($this->model->editTicketsByID($data, $_GET['id'])) {
                echo json_encode(array('status' => 'true', 'messege' => 'Rate info edited successfully!'));
            } else {
                echo json_encode(array('status' => 'false', 'messege' => 'Failed to edit Rate.'));
            }
        }
    }
}
