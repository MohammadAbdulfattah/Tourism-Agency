<?php
class TicketsModel
{
    public $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    //Methods to Get Rate
    public function getAllTickets()
    {
        return $this->db->get('tickets');
    }
    public function getTicketsByID($id)
    {
        $this->db->Where('id', $id);
        return $this->db->get('tickets');
    }
    public function getTicketsByDateS($date_s)
    {
        $this->db->Where('date_s', $date_s);
        return $this->db->get('tickets');
    }
    public function getTicketsByDateE($date_e)
    {
        $this->db->Where('date_e', $date_e);
        return $this->db->get('tickets');
    }
    public function getRateByCompanyId($company_id)
    {
        $this->db->where('company_id', $company_id);
        return $this->db->get('tickets');
    }
    public function getRateByCityId($city_id)
    {
        $this->db->where('city_id', $city_id);
        return $this->db->get('tickets');
    }
    //Method to Add Rate
    public function addTicket($data)
    {
        return $this->db->insert('tickets', $data);
    }
    //Methods to Edit Rate
    public function editTicketsByID($data, $id)
    {
        $this->db->Where('id', $id);
        return $this->db->update('tickets', $data);
    }
    public function editRateByCompanyID($data, $company_id)
    {
        $this->db->Where('company_id', $company_id);
        return $this->db->update('tickets', $data);
    }
    public function editRateByCityID($data, $city_id)
    {
        $this->db->Where('city_id', $city_id);
        return $this->db->update('tickets', $data);
    }
    //Method to Delete Rate
    public function deleteTickets($id)
    {
        $this->db->Where('id', $id);
        $this->db->delete('tickets');
    }

    public function getAllCities()
    {
        $city = $this->db->get('cities');
        return $city;
    }
    public function getAllCompany()
    {
        $company = $this->db->get('companies');
        return $company;
    }

    public function getCityName($city_id)
    {
        $this->db->Where('id', $city_id);
        $cities = $this->db->get('cities');
        foreach ($cities as $city) {
            $cityName = $city['name'];
            return $cityName;
        }
    }
    public function getCompanyName($company_id)
    {
        $this->db->Where('id', $company_id);
        $company = $this->db->get('companies');
        foreach ($company as $comp) {
            $companyName = $comp['name'];
            return $companyName;
        }
    }
    public function getTicketByCompany($company_id)
    {
        $this->db->Where('company_id', $company_id);
        $company = $this->db->get('tickets');
        return $company;
    }
    public function getTicketByCity($city_id)
    {
        $this->db->Where('city_id', $city_id);
        $city = $this->db->get('tickets');
        return $city;
    }
}
